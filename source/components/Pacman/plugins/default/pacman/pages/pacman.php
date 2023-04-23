<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Pacman
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
?>

<script type="text/javascript">		
			
function simulateKeyup(code)
{ 
	var e = jQuery.Event("keyup");
	e.keyCode = code;
	jQuery('#pacman-body').trigger(e);
}
function simulateKeydown(code)
{ 
	var e = jQuery.Event("keydown");
	e.keyCode = code;
	jQuery('#pacman-body').trigger(e);
}
			
$(document).ready(function() { 
	//$.mobile.loading().hide();
				
	$("#pacman-body").attr("tabindex", "0");
	$( "#pacman-body" ).mouseover(function() {
		$("#pacman-body").focus();
	});
				
	loadAllSound();
				
	HELP_TIMER = setInterval('blinkHelp()', HELP_DELAY);
				
	initHome();
				
	$(".sound").click(function(e) { 
		e.stopPropagation();
					
		var sound = $(this).attr("data-sound");
		if ( sound === "on" ) { 
			$(".sound").attr("data-sound", "off");
			$(".sound").find("img").attr("src", "components/Pacman/vendor/img/sound-off.png");
			GROUP_SOUND.mute();
		} else { 
			$(".sound").attr("data-sound", "on");
			$(".sound").find("img").attr("src", "components/Pacman/vendor/img/sound-on.png");
			GROUP_SOUND.unmute();
		}
	});
				
	$(".help-button, #help").click(function(e) { 
		e.stopPropagation();
		if (!PACMAN_DEAD && !LOCK && !GAMEOVER) { 
			if ( $('#help').css("display") === "none") { 
				$('#help').fadeIn("slow");
				$(".help-button").hide();
				if ( $("#panel").css("display") !== "none") { 
					pauseGame();
				}
			} else { 
				$('#help').fadeOut("slow");
				$(".help-button").show();
			}
		}
	});
				
	$(".github").click(function(e) { 
		e.stopPropagation();
	});
				
	$("#home").on("click touchstart", function(e) { 
		if ( $('#help').css("display") === "none") { 
			e.preventDefault();
			simulateKeydown(13);
		}
	});
	$("#control-up, #control-up-second, #control-up-big").on("mousedown touchstart", function(e) { 
		e.preventDefault();
		simulateKeydown(38);
		simulateKeyup(13);
	});
	$("#control-down, #control-down-second, #control-down-big").on("mousedown touchstart", function(e) { 
		e.preventDefault();
		simulateKeydown(40);
		simulateKeyup(13);
	});
	$("#control-left, #control-left-big").on("mousedown touchstart", function(e) { 
		e.preventDefault();
		simulateKeydown(37);
		simulateKeyup(13);
	});
	$("#control-right, #control-right-big").on("mousedown touchstart", function(e) { 
		e.preventDefault();
		simulateKeydown(39);
		simulateKeyup(13);
	});

				
	$("#pacman-body").keyup(function(e) { 
		KEYDOWN = false;
	});
				
	$("#pacman-body").keydown(function(e) { 
				
		if (HOME) { 
					
			initGame(true);
						
		} else { 				
			//if (!KEYDOWN) { 
				KEYDOWN = true;
				if (PACMAN_DEAD && !LOCK) { 
					erasePacman();
					resetPacman();
					drawPacman();
								
					eraseGhosts();
					resetGhosts();
					drawGhosts();
					moveGhosts();
								
					blinkSuperBubbles();
								
				} else if (e.keyCode >= 37 && e.keyCode <= 40 && !PAUSE && !PACMAN_DEAD && !LOCK) { 
					if ( e.keyCode === 39 ) { 
						movePacman(1);
					} else if ( e.keyCode === 40 ) { 
						movePacman(2);
					} else if ( e.keyCode === 37 ) { 
						movePacman(3);
					} else if ( e.keyCode === 38 ) { 
						movePacman(4);
					}
				} else if (e.keyCode === 68 && !PAUSE) { 
					/*if ( $("#canvas-paths").css("display") === "none" ) { 
						$("#canvas-paths").show();
					} else { 
						$("#canvas-paths").hide();
					}*/
				} else if (e.keyCode === 80 && !PACMAN_DEAD && !LOCK) { 
					if (PAUSE) { 
						resumeGame();
					} else { 
						pauseGame();
					}
				} else if (GAMEOVER) { 
					initHome();
				}
			//}
		}
	});
});
</script>

<div class="gbg-11or12-column col-md-11">
<div id="pacman-body">
		
	<div id="sound"></div>
	
	<div id="help">
		<h2><?php echo ossn_print('com:pacman:help:help'); ?></h2>
		<table align="center" border="0" cellPadding="2" cellSpacing="0">
			<tbody>
				<tr><td><?php echo ossn_print('com:pacman:help:left:key'); ?></td><td>&nbsp;<?php echo ossn_print('com:pacman:help:left:action'); ?></td></tr>
				<tr><td><?php echo ossn_print('com:pacman:help:right:key'); ?></td><td>&nbsp;<?php echo ossn_print('com:pacman:help:right:action'); ?></td></tr>
				<tr><td><?php echo ossn_print('com:pacman:help:down:key'); ?></td><td>&nbsp;<?php echo ossn_print('com:pacman:help:down:action'); ?></td></tr>
				<tr><td><?php echo ossn_print('com:pacman:help:up:key'); ?></td><td>&nbsp;<?php echo ossn_print('com:pacman:help:up:action'); ?></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td><?php echo ossn_print('com:pacman:help:pause:key'); ?></td><td>&nbsp;<?php echo ossn_print('com:pacman:help:pause:action'); ?></td></tr>
			</tbody>
		</table>
	</div>
	
	<div id="home">
		<h1>pac-man</h1>
		<h3>Lucio PANEPINTO<br><em>2015</em></h3>
		<canvas id="canvas-home-title-pacman"></canvas>
		<div id="presentation">
			<div id="presentation-titles">character &nbsp;/&nbsp; nickname</div>
			<canvas id="canvas-presentation-blinky"></canvas><div id="presentation-character-blinky">- shadow</div><div id="presentation-name-blinky">"blinky"</div>
			<canvas id="canvas-presentation-pinky"></canvas><div id="presentation-character-pinky">- speedy</div><div id="presentation-name-pinky">"pinky"</div>
			<canvas id="canvas-presentation-inky"></canvas><div id="presentation-character-inky">- bashful</div><div id="presentation-name-inky">"inky"</div>
			<canvas id="canvas-presentation-clyde"></canvas><div id="presentation-character-clyde">- pokey</div><div id="presentation-name-clyde">"clyde"</div>
		</div>
		<canvas id="trailer"></canvas>
		<div class="help-button"><?php echo ossn_print('com:pacman:home:help'); ?></div>
		<a class="sound" href="javascript:void(0);" data-sound="on"><img src="components/Pacman/vendor/img/sound-on.png" alt="" border="0"></a>
	</div>
	
	<div id="panel">
		<h1>pac-man</h1>
		<canvas id="canvas-panel-title-pacman"></canvas>
		<div id="score"><h2><?php echo ossn_print('com:pacman:panel:1up'); ?></h2><span>00</span></div>
		<div id="highscore"><h2><?php echo ossn_print('com:pacman:panel:highscore'); ?></h2><span>00</span></div>
		<div id="board">
			<canvas id="canvas-board"></canvas>
			<canvas id="canvas-paths"></canvas>
			<canvas id="canvas-bubbles"></canvas>
			<canvas id="canvas-fruits"></canvas>
			<canvas id="canvas-pacman"></canvas>
			<canvas id="canvas-ghost-blinky"></canvas>
			<canvas id="canvas-ghost-pinky"></canvas>
			<canvas id="canvas-ghost-inky"></canvas>
			<canvas id="canvas-ghost-clyde"></canvas>
			<div id="control-up-big"></div>
			<div id="control-down-big"></div>
			<div id="control-left-big"></div>
			<div id="control-right-big"></div>
		</div>
		<div id="control">
			<div id="control-up"></div>
			<div id="control-up-second"></div>
			<div id="control-down"></div> 
			<div id="control-down-second"></div>
			<div id="control-left"></div>
			<div id="control-right"></div>
		</div>
		<canvas id="canvas-lifes"></canvas>
		<canvas id="canvas-level-fruits"></canvas>
		<div id="message"></div>
		<div class="help-button"><?php echo ossn_print('com:pacman:panel:help'); ?></div>
		<a class="sound" href="javascript:void(0);" data-sound="on"><img src="components/Pacman/vendor/img/sound-on.png" alt="" border="0"></a>
	</div>
	
</div>
</div>