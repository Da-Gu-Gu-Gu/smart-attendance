<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  
</head>
<body>
  <h1>Pusher Test</h1>

  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>

  <div id="aa" >asdfasf</div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    Pusher.log = function(msg) {
  console.log(msg);
};

    var pusher = new Pusher('c85db90d744de13b28e3', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(data);
      console.log(data);
      document.getElementById("aa").innerHTML=JSON.stringify(data);
      console.log("adf"+JSON.stringify(data));
    });
  </script>
</body>