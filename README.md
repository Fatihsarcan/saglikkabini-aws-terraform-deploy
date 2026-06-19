## Overview
A Laravel-based health/appointment website that I developed myself. This repo covers containerizing it with Docker and deploying it to AWS (EC2, ALB, RDS, ASG) using Terraform, along with the GitHub CI/CD process.
Note: This project does not cover the development stages of the Laravel application itself — it only explains the AWS deployment stages.

---

## Architecture

```mermaid
graph TB
    Dev(["👨‍💻 Developer"])
    User(["🌐 User"])

    subgraph CICD ["CI/CD — GitHub Actions"]
        GH["GitHub\nmain push"]
        Build["Docker Build\n& Push to ECR"]
        Refresh["ASG Instance\nRefresh"]
    end

    subgraph AWS ["☁️ AWS Cloud"]
        ECR["Amazon ECR\nDocker Registry"]

        subgraph VPC ["VPC"]
            subgraph PublicSubnets ["Public Subnets (AZ-a, AZ-b)"]
                ALB["Application\nLoad Balancer"]
            end

            subgraph PrivateSubnets ["Private Subnets (AZ-a, AZ-b)"]
                subgraph ASG ["Auto Scaling Group"]
                    EC2a["EC2 + Docker\nLaravel App\n(AZ-a)"]
                    EC2b["EC2 + Docker\nLaravel App\n(AZ-b)"]
                end
                RDS["RDS MySQL\nPrivate Subnet"]
            end
        end

        subgraph State ["Terraform Remote State"]
            S3State["S3 Bucket\nState File"]
            DDB["DynamoDB\nState Lock"]
        end
    end

    User -->|"HTTPS"| ALB
    ALB -->|"SG: ALB only"| EC2a
    ALB -->|"SG: ALB only"| EC2b
    EC2a -->|"pull image"| ECR
    EC2b -->|"pull image"| ECR
    EC2a -->|"SG: EC2 only"| RDS
    EC2b -->|"SG: EC2 only"| RDS

    Dev -->|"git push"| GH
    GH --> Build
    Build -->|"push image"| ECR
    Build --> Refresh
    Refresh -->|"rolling update"| ASG
```

---

## Docker
We used Docker because it lets us define all the dependencies our Laravel project needs to run (PHP, nginx, PHP extensions, etc.) just once, and have them set up the same way in every environment. This removes the classic "it worked on my machine" problem.
We do this with the Dockerfile: it installs all the required dependencies and copies the project into the image. In the .dockerignore file we list the files and folders we don't want included in the image, such as .env, vendor, and node_modules, so that unnecessary files don't bloat the image and sensitive data like .env doesn't leak.
Finally, we push the image we built to ECR (AWS's Docker image registry) so that AWS can pull it from there and run it.

## Infrastructure (Terraform)
We used Terraform to build the entire AWS infrastructure as code (Infrastructure as Code), instead of creating everything manually from the AWS console. The infrastructure includes a custom VPC with public and private subnets spread across two different availability zones, an Application Load Balancer (ALB) that receives the traffic, an Auto Scaling Group (ASG) that runs the EC2 instances, and an RDS MySQL database located in the private subnets. The EC2 instances run the Laravel application inside a Docker container and pull the image from ECR.
Security is handled with three chained security groups: the ALB accepts traffic from the internet, the EC2 instances accept traffic only from the ALB, and the RDS database accepts traffic only from the EC2 instances. This way, the database stays completely closed to the outside world.
To deploy, the commands terraform init, terraform plan, and terraform apply are run in order. Sensitive values such as the database password are kept in a terraform.tfvars file, which is not pushed to the repo

## CI/CD
To automate the deployment process, we set up a CI/CD pipeline with GitHub Actions. On every code push to the main branch, the pipeline runs automatically: it builds the Docker image, pushes it to ECR, and then triggers an instance refresh on the Auto Scaling Group so the EC2 instances are updated with the new image. This way, code changes go live without any manual steps. The AWS access keys are stored securely in GitHub Secrets instead of being hardcoded

Instead of keeping the Terraform state in a local file, I configured a remote backend. The state is stored in an S3 bucket, and DynamoDB is used for state locking so the state can be shared safely across a team.

<img width="1887" height="946" alt="Ekran görüntüsü 2026-05-30 161812" src="https://github.com/user-attachments/assets/e9e434b2-222b-4afd-9d44-ae5e5357374b" />
<img width="1889" height="956" alt="Ekran görüntüsü 2026-05-30 161526" src="https://github.com/user-attachments/assets/00ce7859-b232-44a4-ba90-8151d0ef5e4c" />
