<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateBedrockToken extends Command
{
    protected $signature   = 'bedrock:token';
    protected $description = 'Bedrock agent için Sanctum API token oluşturur veya yeniler.';

    public function handle(): int
    {
        $user = User::where('email', 'bedrock@internal')->firstOrFail();

        // Eskiyi sil
        $user->tokens()->where('name', 'bedrock-agent')->delete();

        $token = $user->createToken('bedrock-agent')->plainTextToken;

        $this->line($token);
        $this->info('Token oluşturuldu. AWS Secrets Manager\'a kaydet:');
        $this->line("aws secretsmanager put-secret-value --secret-id saglik-bedrock-token --secret-string \"{$token}\"");

        return self::SUCCESS;
    }
}
