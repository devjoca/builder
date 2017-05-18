<?php

namespace App\Ssh;

use App\Project;
use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;

class SshClient implements SshClientGateway
{
    public $user;
    public $host;
    public $script;
    private $private_key;
    private $public_key;

    public function init(Project $project)
    {
        $this->user = $project->sshUser;
        $this->host = $project->sshHost;
        $this->script = $project->deployScript;
        $this->private_key = storage_path("builder_public.key");
        $this->public_key = storage_path("builder_private.key");
    }

    public function runTask()
    {
        $ssh = new SSH2($this->host);
        $key = new RSA;
        if (! file_exists($this->private_key)) {
            $this->generateRsaKey();
        }

        $key->loadKey(file_get_contents($this->private_key));
        if (! $ssh->login($this->user, $key)) {
            return 'error';
        }

        return $ssh->exec($this->script);
    }

    private function generateRsaKey()
    {
        $rsa = new RSA;
        $rsa->setComment('builder');
        $rsa->setPublicKeyFormat(RSA::PUBLIC_FORMAT_OPENSSH);
        $keys = $rsa->createKey(4096);

        file_put_contents($this->private_key, $keys["privatekey"]);
        file_put_contents($this->public_key, $keys["publickey"]);
    }
}