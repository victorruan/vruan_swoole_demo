<?php
$server = stream_socket_server("tcp://0.0.0.0:8000");
$event = event_new();
$base = event_base_new();
$events = [];
event_set($event,$server,EV_READ|EV_PERSIST,function()use($server){
    global $base,$events;
    $conn = stream_socket_accept($server);
    $event = event_new();
    event_set($event,$conn,EV_READ|EV_PERSIST,function()use($conn){
        $info = fread($conn,1024);
        if(strlen($info)>0){
            fwrite($conn,$info);
        }
    });
    event_base_set($event,$base);
    event_add($event);
    $events[] = $event;
});
event_base_set($event,$base);
event_add($event);
event_base_loop($base);