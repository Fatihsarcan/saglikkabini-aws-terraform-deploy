# SES domain identity — verify ettikten sonra sandbox'tan çıkma talebi açılmalı
resource "aws_ses_domain_identity" "main" {
  domain = var.ses_domain
}

resource "aws_ses_domain_dkim" "main" {
  domain = aws_ses_domain_identity.main.domain
}

# EC2'nin SES üzerinden mail gönderebilmesi için IAM policy
resource "aws_iam_role_policy" "ses_send" {
  name = "${var.app_name}-ses-policy"
  role = aws_iam_role.ec2.id

  policy = jsonencode({
    Version = "2012-10-17"
    Statement = [{
      Effect   = "Allow"
      Action   = ["ses:SendEmail", "ses:SendRawEmail"]
      Resource = "*"
    }]
  })
}
