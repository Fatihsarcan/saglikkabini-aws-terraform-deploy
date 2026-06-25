output "alb_dns_name" {
  description = "ALB DNS - buradan siteye erisirsin"
  value       = module.compute.alb_dns_name
}

output "rds_endpoint" {
  description = "RDS endpoint"
  value       = module.database.db_address
}
