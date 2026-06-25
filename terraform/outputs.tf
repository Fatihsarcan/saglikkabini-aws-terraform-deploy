output "alb_dns_name" {
  description = "ALB DNS - buradan siteye erişirsin"
  value       = aws_lb.main.dns_name
}

output "rds_endpoint" {
  description = "RDS endpoint"
  value       = aws_db_instance.main.address
}

output "ses_dkim_tokens" {
  description = "DNS CNAME kayıtları — bunları domain sağlayıcına ekle"
  value       = aws_ses_domain_dkim.main.dkim_tokens
}

output "ses_verification_token" {
  description = "SES domain verification TXT kaydı"
  value       = aws_ses_domain_identity.main.verification_token
}

output "bedrock_lambda_arn" {
  description = "Bedrock action group Lambda ARN"
  value       = aws_lambda_function.bedrock_action.arn
}

output "bedrock_agent_id" {
  description = "Bedrock Agent ID (AWS Console'da test için)"
  value       = aws_bedrockagent_agent.booking.agent_id
}
