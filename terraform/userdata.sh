#!/bin/bash
yum update -y
yum install -y docker
systemctl start docker
systemctl enable docker
# ECR login
aws ecr get-login-password --region ${aws_region} | docker login --username AWS --password-stdin ${ecr_repo}
# Image çek ve çalıştır
docker pull ${ecr_repo}:latest
docker run -d --name laravel \
  -p 80:80 \
  -e APP_ENV=production \
  -e APP_DEBUG=false \
  -e APP_KEY=${app_key} \
  -e DB_CONNECTION=mysql \
  -e DB_HOST=${db_host} \
  -e DB_PORT=3306 \
  -e DB_DATABASE=${db_name} \
  -e DB_USERNAME=${db_username} \
  -e DB_PASSWORD=${db_password} \
  -e SESSION_DRIVER=file \
  -e CACHE_STORE=file \
  --restart always \
  ${ecr_repo}:latest
# Container ayağa kalksın
sleep 20
# Migration (RDS boş, tabloları oluşturur ve doldurur)
docker exec laravel php artisan migrate --force
docker exec laravel php artisan config:cache