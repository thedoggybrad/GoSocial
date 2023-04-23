<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Mastermind Game
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$colors = false;
if ((null !== input('colors')) && (null !== input('key'))) {
	$encrypted_colors_hex = input('colors');
	$key = input('key');
	$encrypted_colors_bin = hex2bin($encrypted_colors_hex);
	if (($decrypted_colors_seq = ossn_string_decrypt($encrypted_colors_bin, $key)) !== false) {
		$colors = $decrypted_colors_seq;
	}
}

?>
<div class="gbg-11or12-column col-md-11">
	<section class="mastermind-body">
		<div class="mastermind-container">
			<div class="mastermind-directions">
				<span class="mastermind-direction-span" onClick="openModal(this)"><button><?php echo ossn_print('com:mastermind:directions:rules'); ?></button></span>
				<span class="mastermind-direction-span" onClick="decColors()"><button>-</button></span>
				<span><button class="mastermind-direction-button"><?php echo ossn_print('com:mastermind:directions:colors'); ?></button></span>
				<span class="mastermind-direction-span" onClick="incColors()"><button>+</button></span>
				<span class="mastermind-direction-span" onClick="decRows()"><button>-</button></span>
				<span><button class="mastermind-direction-button"><?php echo ossn_print('com:mastermind:directions:rows'); ?></button></span>
				<span class="mastermind-direction-span" onClick="incRows()"><button>+</button></span>
				<span class="mastermind-direction-span" onClick="startDiscloseGame()"><button><?php echo ossn_print('com:mastermind:directions:disclose'); ?></button></span>
			</div>

			<div id="mastermind-game-box">
				<div class="mastermind-color-choice-panel">
					<ul class="mastermind-color-list">
						<li><canvas class="" id="canv0" width="50" height="50"></canvas></li>
						<li><canvas class="" id="canv1" width="50" height="50"></canvas></li>
						<li><canvas class="" id="canv2" width="50" height="50"></canvas></li>
						<li><canvas class="" id="canv3" width="50" height="50"></canvas></li>
						<li class="mastermind-invis_peg_list"></li>
						<li><canvas class="" id="canv4" width="50" height="50"></canvas></li>
						<li><canvas class="" id="canv5" width="50" height="50"></canvas></li>
						<li><canvas class="" id="canv6" width="50" height="50"></canvas></li>
						<li><canvas class="" id="canv7" width="50" height="50"></canvas></li>
						<div onClick="checkWin()">
							<button>Guess</button>
						</div>
					</ul>
				</div>

				<div id="mastermind-game-row-panel">
				</div>

				<div class="mastermind-modal" id="mastermind-rules">
					<span class="close cursor" onClick="closeModal()">&times;</span>
					<div class="modal-content">
						<h2><?php echo ossn_print('com:mastermind:modal:header'); ?></h2>
						<p><?php echo ossn_print('com:mastermind:modal:par1'); ?></p>
						<img class="mastermind-modal-img" src="<?php echo ossn_site_url('components/Mastermind/vendor/images/computerCodeExample.png'); ?>">
						<p><?php echo ossn_print('com:mastermind:modal:par2'); ?></p>
						<img class="mastermind-modal-img" src="<?php echo ossn_site_url('components/Mastermind/vendor/images/RedPegSample.png'); ?>">
						<p><?php echo ossn_print('com:mastermind:modal:par3'); ?></p>
						<p><?php echo ossn_print('com:mastermind:modal:par4'); ?></p>
						<p><?php echo ossn_print('com:mastermind:modal:par5'); ?></p>
						<img class="mastermind-modal-img" src="<?php echo ossn_site_url('components/Mastermind/vendor/images/whitePegSample.png'); ?>">
						<p><?php echo ossn_print('com:mastermind:modal:par6'); ?></p>
						<p><?php echo ossn_print('com:mastermind:modal:par7'); ?></p>
					</div>
				</div>
			</div>
		</div>
		<script src="components/Mastermind/vendor/js/script.js"></script>
		<?php
		if ($colors) {
		?>
			<script>
				setAnswer('<?php echo $colors; ?>');
			</script>
		<?php
		}
		?>
	</section>
</div>