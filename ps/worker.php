<?php
$worker = new GearmanWorker();
$worker->addServer();

$worker->addFunction('runruby', 'runruby');

while (1)
{
    $worker->work();
    if ($worker->returnCode() != GEARMAN_SUCCESS) break;
}

function runruby($job)
{
    $workload = $job->workload();
    $data = json_decode($workload, true);

    $e = 'cd '. $data['ps_path'] .'; bundle exec ruby sent.rb '. $data['id'] .' '. $data['uploads_path'] .';';
    system($e);
}