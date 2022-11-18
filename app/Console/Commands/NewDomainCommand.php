<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class NewDomainCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:domain {domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new domain';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $domain_name = $this->argument('domain');
        $this->info("Creating domain $domain_name");
        try {
            $this->createDomain($domain_name);
            $this->info("Domain $domain_name created");
        } catch (\Exception $e) {
            $this->error("Error creating domain $domain_name");
            $this->error($e->getMessage());
        }
        return 0;
    }
    public function createDomain($domain)
    {
        $this->createDomainDirectory($domain);
    }
    public function createDomainDirectory($domain)
    {
        $this->info("Creating domain directory");
        $domainDirectory = File::exists('app/Domains');
        if (!$domainDirectory) {
            mkdir('app/Domains/');
        }
        $domainPath = app_path("Domains/$domain");
        mkdir($domainPath);
        mkdir("$domainPath/Actions");
        mkdir("$domainPath/Http");
        mkdir("$domainPath/Services");
        mkdir("$domainPath/Models");

        mkdir("$domainPath/Http/Controllers");
        mkdir("$domainPath/Http/Middleware");
        mkdir("$domainPath/Http/Requests");
        mkdir("$domainPath/Http/Resources");
    }
}
