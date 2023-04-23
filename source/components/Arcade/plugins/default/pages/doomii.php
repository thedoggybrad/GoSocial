<iframe
    width="680"
    height="400"
    frameborder="0"
    src="https://dos.zone/player/?bundleUrl=https%3A%2F%2Fcdn.dos.zone%2Fcustom%2Fdos%2Fdoom2.jsdos?anonymous=1"
    allowfullscreen>
</iframe>           
<!--
  Message 'dz-player-exit' will be fired when js-dos is exited:
  
    window.addEventListener("message", (e) => {
        if (e.data.message === "dz-player-exit") {
            // ...
        }
    });
--> 
<p>
	<button class="btn btn-primary" align="center" onclick="NewTab()"> 
    FULLSCREEN 
    </button> 
    <script> 
        function NewTab() { 
            window.open("https://dos.zone/player/?bundleUrl=https%3A%2F%2Fcdn.dos.zone%2Fcustom%2Fdos%2Fdoom2.jsdos?anonymous=1", 
                    "", "width=100%, height=100%"); 
        } 
    </script>
</p>