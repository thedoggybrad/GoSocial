<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Mastermind Game
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

ossn_register_languages('en', array(
	'games' => 'Games',
	'com:mastermind:directions:rules' => "Rules",
	'com:mastermind:directions:colors' => "Colors",
	'com:mastermind:directions:rows' => "Rows",
	'com:mastermind:directions:disclose' => "Disclose",
    'com:mastermind:modal:header' => "Mastermind Rules of the Game",
	'com:mastermind:modal:par1' => "The computer randomly picks a sequence of colors, such as the sequence below:",
	'com:mastermind:modal:par2' => "The objective of the game is to guess the exact positions of the colors in the computer's sequence. To choose a color, click or touch one of the eight colors at the top of the screen. Then click or touch the first empty row where you would like to place the color.  After you choose a color for all four empty slots, click on the 'Guess' button. The computer responses with feedback from your guess.",
	'com:mastermind:modal:par3' => "Feedback is given as follows: For each color in your guess that is in the correct color and correct position in the code sequence, the computer display a small red peg on the right side of the current guess. For example one red peg means you have one correct color in the correct spot, but you don't know *which* color.",
	'com:mastermind:modal:par4' => "For each color in your guess that is in the correct color but the wrong spot, the computer display a small white peg on the right side of the current guess. For example two white pegs mean you have two correct colors, but they are in the wrong spot.",
	'com:mastermind:modal:par5' => "Any color can be used any number of times in the code sequence.",
	'com:mastermind:modal:par6' => "You win the game when you guess all the colors in the code sequence all in the correct position. You will lose the game if you can't guess after ten attempts.",
	'com:mastermind:modal:par7' => "Good luck. Guess well.",
	'com:mastermind:message:box:title:ended' => "Mastermind - End of game",
	'com:mastermind:message:box:title:disclosed' => "Mastermind - Current colors",
	'com:mastermind:message:box:won' => "Congratulations - You won! <br>The correct color sequence was: ",
	'com:mastermind:message:box:lost' => "Sorry - You lost. <br>The correct color sequence was: ",
	'com:mastermind:message:box:disclosed' => "The current color sequence to guess is: ",
	'com:mastermind:message:box:disclosed:multiplay' => "If you want others to guess these colors, tell them to open the Mastermind page and add the above string to the URL.",
	'com:mastermind:message:box:ok' => "Ok",
));
