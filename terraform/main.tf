terraform {
  backend "s3" {
    bucket         = "saglikkabini-tfstate-fatih"
    key            = "terraform.tfstate"
    region         = "eu-central-1"
    dynamodb_table = "saglikkabini-tf-lock"
    encrypt        = true
  }

  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 5.0"
    }
  }
}

provider "aws" {
  region = var.aws_region
}

module "network" {
  source     = "./modules/network"
  app_name   = var.app_name
  aws_region = var.aws_region
}

module "security" {
  source   = "./modules/security"
  app_name = var.app_name
  vpc_id   = module.network.vpc_id
}

module "database" {
  source            = "./modules/database"
  app_name          = var.app_name
  subnet_ids        = module.network.private_subnet_ids
  security_group_id = module.security.rds_sg_id
  db_name           = var.db_name
  db_username       = var.db_username
  db_password       = var.db_password
}

module "compute" {
  source            = "./modules/compute"
  app_name          = var.app_name
  aws_region        = var.aws_region
  vpc_id            = module.network.vpc_id
  public_subnet_ids = module.network.public_subnet_ids
  alb_sg_id         = module.security.alb_sg_id
  ec2_sg_id         = module.security.ec2_sg_id
  ami_id            = var.ami_id
  ecr_repo_url      = var.ecr_repo_url
  db_host           = module.database.db_address
  db_name           = var.db_name
  db_username       = var.db_username
  db_password       = var.db_password
  app_key           = var.app_key
  userdata_path     = "${path.module}/userdata.sh"
}
