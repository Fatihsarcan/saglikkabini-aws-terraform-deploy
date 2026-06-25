# Lambda execution role
resource "aws_iam_role" "bedrock_lambda" {
  name = "${var.app_name}-bedrock-lambda-role"

  assume_role_policy = jsonencode({
    Version = "2012-10-17"
    Statement = [{
      Action    = "sts:AssumeRole"
      Effect    = "Allow"
      Principal = { Service = "lambda.amazonaws.com" }
    }]
  })
}

resource "aws_iam_role_policy_attachment" "lambda_basic" {
  role       = aws_iam_role.bedrock_lambda.name
  policy_arn = "arn:aws:iam::aws:policy/service-role/AWSLambdaBasicExecutionRole"
}

# Lambda function — zip CI tarafından deploy edilir
resource "aws_lambda_function" "bedrock_action" {
  function_name = "${var.app_name}-bedrock-action"
  role          = aws_iam_role.bedrock_lambda.arn
  handler       = "index.handler"
  runtime       = "nodejs20.x"

  # İlk apply için placeholder zip; sonraki CI deploy'ları üzerine yazar
  filename = "${path.module}/../lambda/bedrock_action.zip"

  source_code_hash = filebase64sha256("${path.module}/../lambda/bedrock_action.zip")

  environment {
    variables = {
      LARAVEL_API_URL   = "http://${aws_lb.main.dns_name}/api"
      LARAVEL_API_TOKEN = var.bedrock_api_token
    }
  }
}

resource "aws_lambda_permission" "bedrock_invoke" {
  statement_id  = "AllowBedrockInvoke"
  action        = "lambda:InvokeFunction"
  function_name = aws_lambda_function.bedrock_action.function_name
  principal     = "bedrock.amazonaws.com"
}

# Bedrock Agent IAM role
resource "aws_iam_role" "bedrock_agent" {
  name = "${var.app_name}-bedrock-agent-role"

  assume_role_policy = jsonencode({
    Version = "2012-10-17"
    Statement = [{
      Effect    = "Allow"
      Principal = { Service = "bedrock.amazonaws.com" }
      Action    = "sts:AssumeRole"
    }]
  })
}

resource "aws_iam_role_policy" "bedrock_agent_policy" {
  role = aws_iam_role.bedrock_agent.id

  policy = jsonencode({
    Version = "2012-10-17"
    Statement = [
      {
        Effect   = "Allow"
        Action   = ["bedrock:InvokeModel"]
        Resource = "*"
      },
      {
        Effect   = "Allow"
        Action   = ["lambda:InvokeFunction"]
        Resource = aws_lambda_function.bedrock_action.arn
      }
    ]
  })
}

# Bedrock Agent (aws provider >= 5.50 gerektirir)
resource "aws_bedrockagent_agent" "booking" {
  agent_name              = "${var.app_name}-booking-agent"
  agent_resource_role_arn = aws_iam_role.bedrock_agent.arn
  foundation_model        = "anthropic.claude-3-haiku-20240307-v1:0"
  idle_session_ttl_in_seconds = 600

  instruction = <<-EOT
    Sen bir sağlık kliniği randevu asistanısın. Türkçe konuşuyorsun.
    Hastaların doktor listesini görmesine, müsait randevu saatlerini sorgulamasına
    ve randevu almasına veya iptal etmesine yardımcı oluyorsun.
    Randevu almadan önce hastanın hangi doktoru ve hangi tarihi istediğini teyit et.
    Her işlem sonucunu açıkça raporla. Sadece sağlık kliniği konularında yardımcı ol.
  EOT
}

resource "aws_bedrockagent_agent_action_group" "booking" {
  agent_id          = aws_bedrockagent_agent.booking.agent_id
  agent_version     = "DRAFT"
  action_group_name = "BookingActions"

  action_group_executor {
    lambda = aws_lambda_function.bedrock_action.arn
  }

  api_schema {
    payload = file("${path.module}/bedrock_openapi.json")
  }
}
