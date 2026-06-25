variable "aws_region" {
  default = "eu-central-1"
}

variable "app_name" {
  default = "laravel-saglik"
}

variable "ecr_repo_url" {
  default = "290971954748.dkr.ecr.eu-central-1.amazonaws.com/laravel-saglik"
}

variable "ami_id" {
  description = "Amazon Linux 2023 AMI - eu-central-1"
  default     = "ami-0a23a9827c6dab833"
}

variable "db_name" {
  default = "saglik_db"
}

variable "db_username" {
  default = "admin"
}

variable "db_password" {
  description = "RDS MySQL password"
  sensitive   = true
}

variable "app_key" {
  description = "Laravel APP_KEY"
  sensitive   = true
  default     = ""
}

variable "ses_domain" {
  description = "SES için verify edilecek domain (ör: saglik.example.com)"
  default     = "saglik.example.com"
}

variable "ses_from_address" {
  description = "Maillerden gönderilecek adres"
  default     = "noreply@saglik.example.com"
}

variable "bedrock_api_token" {
  description = "Laravel Sanctum token (php artisan bedrock:token ile üretilir)"
  sensitive   = true
  default     = ""
}
