      .menu-section-games i:before {
    	content: "\f11b";
       }
       .menu-section-item-treasures:before {
       content: "\f006" !important;
       }
	  .csbox {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
             .csoben {
            position: relative;
			width: 90%;
			margin: 10px;
        }
        .imgPart {
            background: #fff;
			border-radius: 20px 20px 20px 20px;
        }
        .imgPart img {
            border: 5px solid #afafaf;
            border-radius: 20px 20px 0 0;
            border-bottom: none;
            display: block;
            height: calc(70vh - 110px);
            object-fit: cover;
            width: 100%;
        }
        .overlay {
            position: absolute;
            z-index: 1;
        }
        .emojiContainer {
            background: rgba(0, 0, 0, 0);
            left: 0;
            top: 0;  
        }
        .emojis {
            background: rgba(255, 0, 0, 0);
            /*background: red;*/
            border-radius: 50% 50%;
            color: black;
            display: inline-block;
            font-size: 25px;
            padding: 2px;
            position: absolute;
            text-align: center;
            z-index: 2
        }
        .emojisClicked {
            background: #fff;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: inset 3px 3px 12px black;
            box-shadow: outset 3px 3px 12px white;
        }
        .banner {
            animation: bannerBox 0.3s 1;
            background: rgba(0, 0, 0, 0.8);
            box-sizing: border-box;
			 border: 5px solid #afafaf;
			 border-radius: 20px 20px 20px 20px;
            color: yellow;
            display: none;
            font-size: 36px;
            font-weight: 600;
            height: 65%;
            padding: 20px;
            text-align: center;
            top: 62px;
            width: 96%;
            z-index: 3;
        }
        .scores {
            background: blue;
            color: #98daff;
            border: 5px solid #afafaf;
            border-radius: 0 0 20px 20px;
            font-size: 17px;
            font-weight: 500;
            height: 100px;
            width: 100%;
            padding: 10px;
            position: relative;
        }
        #emojiLeft,
        #scores,
        #stage {
            font-weight: 700;
            font-family: monospace;
            text-shadow: 1px 1px 10px #fff;
            overflow: hidden;
        }
        .scoresBox {
            background: blue;
            border-radius: 0 0 15px 0;
            height: 100%;
            padding: 0 10px;
            right: 0;
            top: 0;
            width: 180px;
        }

        .leftEmojiChild{
            border: 1px solid brown;
            border-radius: 5px;
            background: rgba(0,0,0,0.4);
        }
        #timer {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 50% 50%;
            float: right;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            padding: 3px;
            text-shadow: 2px 2px 10px #fff;
        }
        canvas{
            
            z-index: 10;
            top: 0;
            left: 0;
        }
        @keyframes bannerBox {
            from {
                transform: scale(0.1) rotate(0deg);
            }
            to {
                transform: scale(1.0) rotate(360deg);
            }
        }
            .emojis {
                font-size: 20px;
            }
        } 