<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
	
		
   
    



    <div class="csoben">
	
	<div class="ossn-page-contents">
	<div class="ossn-widget">
		<div class="widget-heading">
			<i class="fa fa-star"></i> <?php echo ossn_print('cs_treasures:title'); ?>
		</div>
		<div class="widget-contents">
	
        <div class="overlay loadingPage">

        </div>
        <div class="imgPart">
            <img src="./he1.jpg" height="450px" width="340px" alt="Background image for the hidden emoji game" onerror="this.onerror=null;
            this.src='https://media.giphy.com/media/26u448sAtjuAR3pok/giphy.gif'">
        </div>
        <div class="overlay emojiContainer"></div>
        <div class="overlay banner"></div>
        <div class="scores">
            <p class="csbox"><?php echo ossn_print('cs_treasures:emojis'); ?><span id="emojiLeft">15</span></p>
            <p class="csbox"><?php echo ossn_print('cs_treasures:score'); ?> <span id="scores">0</span></p>
            <p class="csbox"><?php echo ossn_print('cs_treasures:level'); ?><span id="stage">1</span> </p>
            <div class="overlay scoresBox">
              <span id="timer">100</span>
              <span class="leftEmojis"></span>
            </div>
        </div>
    </div>
<center>

<script>
    'use strict';
    const EMOJI_ARRAY = ["🐌", "👑", "🦂", "💎", "🐍", "🐢", "🐠", "💍", "⚓", "🐚", "🐟", "🐡", "💰", "🐳", "🐋"];
    
        /* Set the values between 0 and 100 to position the emojis*/
        const EMOJI_TOP_OFFSETS = [
            //For image1

             [70, 85, 70, 98, 84, 60, 90, 40, 67, 36, 80, 90, 90, 97, 79],
            //For image2
            [95, 50, 72, 92, 98, 90, 58, 45, 99, 48, 90, 71, 99, 59, 85],
            //For image3
            [69, 55, 5, 85, 39, 95, 50, 3, 87, 80, 66, 64, 70, 24, 45],
              //4
            [80, 49, 30, 95, 50, 65, 90, 99, 30, 55, 65, 75, 85, 90, 55],
               //5
            [10, 70, 40, 99, 58, 40, 99, 30, 97, 78, 90, 21, 45, 79, 40],
               //6
            [50, 95, 60, 25, 70, 85, 80, 15, 75, 55, 65, 99, 55, 90, 95],
               //7
            [80, 95, 40, 25, 80, 45, 99, 15, 40, 55, 65, 75, 55, 90, 95],
               //8
            [0, 40, 75, 85, 79, 55, 15, 15, 27, 60, 96, 99, 40, 54, 90],
            //9
            [45, 56, 32, 32, 58, 70, 98, 80, 20, 78, 90, 21, 5, 79, 65],
            //For image10
            [95, 66, 99, 62, 48, 70, 55, 45, 50, 78, 90, 91, 50, 99, 85],
            
            
        ];

        const EMOJI_LEFT_OFFSETS = [
            //For image1

             [60, 86, 99, 12, 19, 50, 54, 65, 20, 28, 70, 99, 35, 45, 37],
            //For image2
            [10, 90, 60, 40, 69, 30, 45, 23, 47, 56, 99, 29, 19, 54, 80],
            //For image3
            [99, 46, 10, 22, 38, 30, 58, 60, 87, 68, 80, 71, 45, 59, 45],
               //4
            [5, 95, 0, 85, 70, 60, 40, 0, 80, 55, 95, 35, 75, 30, 15],
                 //5
            [40, 75, 5, 80, 69, 60, 99, 23, 37, 56, 16, 29, 50, 34, 70],
               //6
            [48, 46, 10, 22, 8, 30, 88, 55, 77, 68, 80, 71, 15, 9, 30],

                 //7
            [5, 95, 20, 45, 70, 95, 0, 25, 80, 55, 95, 35, 75, 30, 15],
            //8
             [5, 20, 82, 10, 18, 90, 75, 65, 87, 48, 70, 99, 35, 19, 37],
            //For image9
            [5, 95, 20, 45, 70, 85, 40, 25, 80, 55, 95, 35, 75, 70, 99],
            //For image10
            [35, 46, 10, 22, 88, 60, 68, 55, 77, 68, 80, 71, 15, 9, 10],
              

        ];

        const IMAGE_LINKS_ARRAY = [
            //image1 link
         "https://media.giphy.com/media/ZTAojHK9IHsSQ/giphy.gif",
         "https://media.giphy.com/media/26u47309v8SiMoiKk/giphy.gif",     
         "https://media.giphy.com/media/l378tttNPcKvtLwLC/giphy.gif",
         "https://media.giphy.com/media/XbaUe0JcXfX0t4unAC/giphy.gif",
         "https://media.giphy.com/media/AHmRAFy1N4q3e/giphy.gif",  
         "https://media.giphy.com/media/l4pTcmiPcgVnekwog/giphy.gif",
         "https://media.giphy.com/media/YkumqbKTDWKTOtK8ew/giphy.gif",
         "https://media.giphy.com/media/fxBUVmwA8MAvpw7nif/giphy.gif",      
        ];

        const MESSAGE_ARRAY = [
          "<?php echo ossn_print('cs_treasures:that'); ?>",
          "<?php echo ossn_print('cs_treasures:thit'); ?>",
          "<?php echo ossn_print('cs_treasures:thit1'); ?>",
          "<?php echo ossn_print('cs_treasures:thit2'); ?>",
          "<?php echo ossn_print('cs_treasures:thit3'); ?>",
          "<?php echo ossn_print('cs_treasures:thit4'); ?>",
          "<?php echo ossn_print('cs_treasures:thit5'); ?>",
          "<?php echo ossn_print('cs_treasures:thit6'); ?>",
          "<?php echo ossn_print('cs_treasures:thit7'); ?>",
          "<?php echo ossn_print('cs_treasures:thit8'); ?>",
          "<?php echo ossn_print('cs_treasures:thit9'); ?>"
        ];

        const BANNER_TIME = 3000;
        const EMOJI_CLICK_TIME = 500;

        var body = document.body;
        var container = document.querySelector('.container');
        var emojiContainer = document.querySelector('.emojiContainer');
        var banner = document.querySelector('.banner');
        var clickCounter = EMOJI_ARRAY.length;
        var imgWidth;
        var imgHeight;
        var emojiDiv;
        var emojiText;
        var stage = 0;
        var scores = 0;
        var iteration = 0;
        var fontsize = 20;
        var timeElapsed = 0;
        var gameTimer; //setInterval variable for timer
        var maxStageTime = 100; //in seconds


        window.onload = function() {
            if (clickCounter !== 0) {
                displayBanner("<?php echo ossn_print('cs_treasures:hidden'); ?> ");
                createGame();
                updateScores();
            } else {
                nextStage();
            }
        };

        //stars animation object literal
        var stars = {
            canvas: document.createElement('CANVAS'),
            createStars: function(parent, width = 300, height = 300,
              starCount = 50, maxRadius = 50, durMillis = 3000,
              isRings = true, clickX = undefined, clickY = undefined) {
                var canvas = stars.canvas;
                var ctx = canvas.getContext('2d');
                parent.appendChild(canvas);

                //canvas styles
                canvas.style.background = "rgba(0,0,0,0)";
                canvas.width = width;
                canvas.height = height;

                var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
                    window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
                var cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame;

                var starArray = [];
                var myFrames;

                function Star(posX, posY, radius, innerRadius, rotateAngle, velocity, color) {
                    this.opacity = 1.0;
                    this.posX = posX;
                    this.posY = posY;
                    this.radius = radius;
                    this.innerRadius = innerRadius; //innerRadius for star
                    this.rotateAngle = rotateAngle;
                    this.velocity = velocity;
                    this.color = color;
                }

                Star.prototype.draw = function() {
                    var r = this.radius;
                    var iR = this.innerRadius;
                    var x = this.posX;
                    var y = this.posY;
                    var ang = Math.PI / 5;
                    var rA = this.rotateAngle;
                    ctx.fillStyle = this.color;
                    ctx.beginPath();
                    ctx.moveTo(x + r * Math.cos(rA + ang * 0), y + r * Math.sin(rA + ang * 0));
                    ctx.lineTo(x + iR * Math.cos(rA + ang * 1), y + iR * Math.sin(rA + ang * 1));
                    ctx.lineTo(x + r * Math.cos(rA + ang * 2), y + r * Math.sin(rA + ang * 2));
                    ctx.lineTo(x + iR * Math.cos(rA + ang * 3), y + iR * Math.sin(rA + ang * 3));
                    ctx.lineTo(x + r * Math.cos(rA + ang * 4), y + r * Math.sin(rA + ang * 4));
                    ctx.lineTo(x + iR * Math.cos(rA + ang * 5), y + iR * Math.sin(rA + ang * 5));
                    ctx.lineTo(x + r * Math.cos(rA + ang * 6), y + r * Math.sin(rA + ang * 6));
                    ctx.lineTo(x + iR * Math.cos(rA + ang * 7), y + iR * Math.sin(rA + ang * 7));
                    ctx.lineTo(x + r * Math.cos(rA + ang * 8), y + r * Math.sin(rA + ang * 8));
                    ctx.lineTo(x + iR * Math.cos(rA + ang * 9), y + iR * Math.sin(rA + ang * 9));
                    ctx.lineTo(x + r * Math.cos(rA + ang * 0), y + r * Math.sin(rA + ang * 0));
                    ctx.fill();
                }

                function blastRings(x, y, radius, lw, color) {
                    if (radius < 0) radius = 0;
                    ctx.beginPath();
                    ctx.lineWidth = lw;
                    ctx.strokeStyle = color;
                    ctx.arc(x, y, radius + 30, 0, Math.PI * 2, false);
                    ctx.stroke();
                }

                Star.prototype.updatePosition = function() {
                    this.posX += this.velocity * Math.cos(this.rotateAngle);
                    this.posY += this.velocity * Math.sin(this.rotateAngle);
                    this.draw();
                }

                for (var i = 0; i < starCount; i++) {
                    starArray.push(new Star(
                        clickX || Math.floor(((Math.random() - 0.5) * 30) + (width / 2)),
                        clickY || Math.floor(((Math.random() - 0.5) * 30) + (height / 2)),
                        Math.floor(Math.random() * maxRadius),
                        maxRadius * (Math.random() * 0.4 + 0.2),
                        Math.random() * (2 * Math.PI),
                        Math.ceil(Math.random() * 10),
                        `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 1.0)`
                    ));
                    // starArray[i].draw();
                }

                var start = null;

                function animate(timestamp) {
                    if (!start) start = timestamp;
                    var progress = timestamp - start;
                    //console.log(progress + " , " + durMillis);

                    ctx.clearRect(0, 0, width, height);
                    if(isRings){
                      blastRings(width / 2, height / 2, progress, 10, "white");
                      blastRings(width / 2, height / 2, progress - 50, 15, "yellow");
                      blastRings(width / 2, height / 2, progress - 100, 20, "orange");
                      blastRings(width / 2, height / 2, progress - 150, 30, "red");
                    }
                    starArray.forEach(function(item) {
                        item.updatePosition();
                    });

                    if (progress < durMillis) {
                        myFrames = requestAnimationFrame(animate);
                    } else {
                        stars.removeStars(parent);
                    }
                }

                requestAnimationFrame(animate);

            }, //createStars () function end

            removeStars: function(parent){
              var children = parent.children;
              for(var i = 0; i < children.length; i++){
                if(children[i] === stars.canvas){
                  parent.removeChild(stars.canvas);
                  break;
                }
              }
            }//removeStars () function ends here

        } // stars object literal end

        // creating the emojis on top of image
        function createGame() {
            imgWidth = document.querySelector('.imgPart img').width;
            imgHeight = document.querySelector('.imgPart img').height;

            for (var i = 0; i < EMOJI_ARRAY.length; i++) {
                emojiDiv = document.createElement("DIV");
                emojiText = document.createTextNode(EMOJI_ARRAY[i]);
                emojiDiv.setAttribute("class", "emojis");
                emojiDiv.setAttribute("id", "emoji" + (i + 1));
                emojiDiv.style.fontSize = "" + fontsize + "px";
                emojiDiv.style.top = Math.floor((EMOJI_TOP_OFFSETS[stage % IMAGE_LINKS_ARRAY.length][i] / 100) * (imgHeight - 50)) + "px";
                emojiDiv.style.left = Math.floor((EMOJI_LEFT_OFFSETS[stage % IMAGE_LINKS_ARRAY.length][i] / 100) * (imgWidth - 50)) + "px";

                emojiDiv.appendChild(emojiText);
                emojiContainer.appendChild(emojiDiv);

                emojiDiv.addEventListener('click', handleEmojiClick);

            }
            clickCounter = EMOJI_ARRAY.length;
            setGameTimer();
            displayLeftEmojis();
        }

        function setGameTimer() {
            timeElapsed = 0;
            gameTimer = setInterval(function() {
                timeElapsed += 1;
                document.querySelector('#timer').textContent = maxStageTime - timeElapsed;
                if (maxStageTime - timeElapsed === 0) {
                    gameOver();
                }
            }, 1000);
        }

        function gameOver() {
            iteration = 0;
            scores = 0;
            stage = 0;
            timeElapsed = 0;
            fontsize = 20;
            clearInterval(gameTimer);
            removeEmojis(emojiContainer);
            removeEmojis(document.querySelector('.leftEmojis'));
            createGame();
            updateScores();
            displayBanner("<?php echo ossn_print('cs_treasures:thit10'); ?>", true);
        }

        function handleEmojiClick(event) {
            this.setAttribute('class', 'emojis emojisClicked');
            clickCounter--;
            scores += 100;

            //displayLeftEmojis part now
            document.querySelectorAll('.leftEmojiChild').forEach((item) => {
              if(this.textContent === item.textContent){
                document.querySelector('.leftEmojis').removeChild(item);              }
            });

            if (clickCounter === 0) {
                scores += 500;
                setTimeout(function(){
                  stars.createStars(document.body, innerWidth, innerHeight, 100, 15, BANNER_TIME, true);
                }, EMOJI_CLICK_TIME + 50);
                nextStage();
            }

            //display and remove the star canvas
            stars.createStars(document.body, innerWidth, innerHeight,
              20, 20, EMOJI_CLICK_TIME, false, event.pageX, event.pageY);
            setTimeout(function(){
              stars.removeStars(document.body);
              if(clickCounter === 0){
              }
            }, EMOJI_CLICK_TIME);

            updateScores();
            this.removeEventListener('click', handleEmojiClick);
        }

        function updateScores() {
            document.querySelector('#emojiLeft').textContent = clickCounter;
            document.querySelector('#scores').textContent = scores;
            document.querySelector('#stage').textContent = stage + 1;
        }

        function displayBanner(bannerText, noClick = false) {
            banner.innerHTML = bannerText;
            banner.style.display = "block";

            //create the stars animation
            stars.createStars(document.body, innerWidth, innerHeight, 100, 15, BANNER_TIME, true);

            if (!noClick) {
                banner.addEventListener('click', bannerClick);
            }

            function bannerClick() {
                banner.style.display = "none";
            }
            setTimeout(function() {
                banner.style.display = "none";
                banner.removeEventListener('click', bannerClick);
            }, BANNER_TIME);
        }

        function nextStage() {
            stage += 1;
            clearInterval(gameTimer);
            if ((stage % (IMAGE_LINKS_ARRAY.length)) === 0) {
                iteration += 1;
                nextIteration();
            } else {
                scores += (maxStageTime - timeElapsed) * 10;
                displayBanner(`TIME BONUS ${(maxStageTime - timeElapsed) * 10} POINTS<br/> <hr/>${MESSAGE_ARRAY[Math.floor(Math.random() * MESSAGE_ARRAY.length)]}`);
            }
            document.querySelector('.imgPart img').src = IMAGE_LINKS_ARRAY[stage % IMAGE_LINKS_ARRAY.length];
            removeEmojis(emojiContainer);
            removeEmojis(document.querySelector('.leftEmojis'));
            document.querySelector('.imgPart img').addEventListener("load", createGame);
        }

        function removeEmojis(parent) {
            while (parent.firstChild) {
                parent.removeChild(parent.firstChild);
            }
        }

        function nextIteration() {

            fontsize -= 2;
            if(maxStageTime > 30){
              maxStageTime -= 10;
            }
            displayBanner("<?php echo ossn_print('cs_treasures:thit11'); ?>");
        }

        function getRandomColor() {
            return `rgb(${Math.floor(Math.random() * 255)},
            ${Math.floor(Math.random() * 255)},
            ${Math.floor(Math.random() * 255)})`;
        }

        function displayLeftEmojis(){
            EMOJI_ARRAY.forEach((item) => {
              let span = document.createElement('SPAN');
              span.setAttribute('class', 'leftEmojiChild');
              let content = document.createTextNode(item);
              span.appendChild(content);
              document.querySelector('.leftEmojis').appendChild(span);
            });
        }
     </script>
	  <div class="alert alert-danger">
			 <?php echo ossn_print('cs_treasures:info'); ?>
		</div>
	 </center>
    
  