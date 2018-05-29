<html>
    <head>
        <style>
            #Gomb {
                position: relative;
                width: 160px;
                height: 60px;
            }

            #Info {
                position: relative;
                z-index: -1;
                font-size: 16;
            }
        </style>

        <script src="jquery-3.2.1.min.js"></script>
        <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.green-deep_purple.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <script>

            var buttonWidth = 160;
            var buttonHeight = 60;

            function clicked() {
                window.location = "Login.php";
            }

            function reposition() {
                var windowWidth = window.innerWidth;
                var windowHeight = window.innerHeight;

                var minPosX = 100 / windowWidth * buttonWidth;
                var maxPosX = 100;

                var minPosY = 100 / windowHeight * buttonHeight;
                var maxPosY = 100;

                var randPosX = Math.floor((Math.random() * (maxPosX - minPosX)) + minPosX);
                var randPosY = Math.floor((Math.random() * (maxPosY - minPosY)) + minPosY);

                var numberX = windowWidth * randPosX / 100 - buttonWidth;
                var numberY = windowHeight * randPosY / 100 - buttonHeight;
                if (numberX < 0) numberX = 0;
                if (numberY < 0) numberY = 0;

                document.getElementById("Gomb").style.left = numberX;
                document.getElementById("Gomb").style.top = numberY;
            }

            function defaultPosition() {
                var windowWidth = window.innerWidth;
                var windowHeight = window.innerHeight;

                var numberX = windowWidth * 0.5 - buttonWidth / 2;
                var numberY = windowHeight * 0.5 - buttonHeight / 2;

                document.getElementById("Gomb").style.left = numberX;
                document.getElementById("Gomb").style.top = numberY;

            
                document.getElementById("Info").style.top = 0;
            }

        </script>
    </head>

    <body onload="defaultPosition()">

        <button tabindex="-1" id="Gomb" class="mdl-button mdl-button mdl-button--raised mdl-js-ripple-effect" 
                onmouseover="reposition()" onclick="clicked()" onmouseenter="reposition()" onmousedown="reposition()" onmousemove="reposition()">
            Javítás!
        </button>


        <div id = "Info" align="center">
            Sajnos a Jupiter rendszer jelenleg nem elérhető. <br>
            A probléma megoldásához kattintson a javítás gombra! <br>
        </div>


    </body>
</html>