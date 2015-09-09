<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>CamanJS demo</title>
	<script src="js/jquery-2.1.3.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/caman.full.min.js"></script>
	<link rel="stylesheet" href="css/jquery-ui.css">
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 30px;
		}
		label {
			font-size: 0.9em;
			margin: 10px 0 5px;
			display: block;
			position: relative;
		}
		.v {
			position: absolute;
			right: 0;
			font-size: 0.7em;
			color: #aaa;
		}
		#left-col {
			float: left;
			width: 250px;
			font-size: 0.7em;
		}
		button {
			margin: 5px 5px 0 0;
		}
	</style>
</head>
<body>
	<div id="left-col">
		<div id="accordion">
			<h3>Adjust</h3>
			<div>
				<label>Brightness <span class="v" id="v-brightness">0</span></label>
				<div class="slider" id="brightness" data-min="-100" data-max="100" data-val="0"></div>
				<label>Contrast <span class="v" id="v-contrast">0</span></label>
				<div class="slider" id="contrast" data-min="-100" data-max="100" data-val="0"></div>
				<label>Saturation <span class="v" id="v-saturation">0</span></label>
				<div class="slider" id="saturation" data-min="-100" data-max="100" data-val="0"></div>
				<label>Vibrance <span class="v" id="v-vibrance">0</span></label>
				<div class="slider" id="vibrance" data-min="-100" data-max="100" data-val="0"></div>
				<label>Exposure <span class="v" id="v-exposure">0</span></label>
				<div class="slider" id="exposure" data-min="-100" data-max="100" data-val="0"></div>

				<label>Clip <span class="v" id="v-clip">0</span></label>
				<div class="slider" id="clip" data-min="0" data-max="100" data-val="0"></div>
				<label>Hue <span class="v" id="v-hue">0</span></label>
				<div class="slider" id="hue" data-min="0" data-max="100" data-val="0"></div>
				<label>Sepia <span class="v" id="v-sepia">0</span></label>
				<div class="slider" id="sepia" data-min="0" data-max="100" data-val="0"></div>
				<label>Noise <span class="v" id="v-noise">0</span></label>
				<div class="slider" id="noise" data-min="0" data-max="100" data-val="0"></div>
				<label>Sharpen <span class="v" id="v-sharpen">0</span></label>
				<div class="slider" id="sharpen" data-min="0" data-max="100" data-val="0"></div>
			</div>
			<h3>Resize</h3>
			<div>
				<label>Width</label><input value="300" id="resize-w"/>
				<label>Height</label><input value="200" id="resize-h" />
				<br />
				<button id="resize">Apply</button>
			</div>
			<h3>Crop</h3>
			<div>
				<label>X</label><input value="100" id="crop-x"/>
				<label>Y</label><input value="100" id="crop-y" />
				<label>Width</label><input value="400" id="crop-w"/>
				<label>Height</label><input value="300" id="crop-h" />
				<br />
				<button id="crop">Apply</button>
			</div>
			<h3>Rotate</h3>
			<div>
				<button id="rotate-cw">Rotate CW</button>
				<button id="rotate-ccw">Rotate CCW</button>
			</div>
			<h3>Presets</h3>
			<div>
				<button class="preset" data-preset="clarity">Clarity</button>
				<button class="preset" data-preset="pinhole">Pinhole</button>
				<button class="preset" data-preset="love">Love</button>
				<button class="preset" data-preset="jarques">Jarques</button>
				<button class="preset" data-preset="orangePeel">Orange Peel</button>
				<button class="preset" data-preset="sinCity">Sin City</button>
				<button class="preset" data-preset="grungy">Grungy</button>
				<button class="preset" data-preset="oldBoot">Old Boot</button>
				<button class="preset" data-preset="lomo">Lomo</button>
				<button class="preset" data-preset="vintage">Vintage</button>
				<button class="preset" data-preset="crossProcess">Cross Process</button>
				<button class="preset" data-preset="concentrate">Concentrate</button>
				<button class="preset" data-preset="glowingSun">Glowing Sun</button>
				<button class="preset" data-preset="sunrise">Sunrise</button>
				<button class="preset" data-preset="nostalgia">Nostalgia</button>
				<button class="preset" data-preset="hemingway">Hemingway</button>
				<button class="preset" data-preset="herMajesty">Her Majesty</button>
				<button class="preset" data-preset="hazyDays">Hazy Days</button>
			</div>
		</div>
		<div>
			<button id="reset">Reset</button>
			<button id="save">Save</button>
		</div>
	</div>



	<div id="image-area">
		<img style="margin: 50px auto; display: block;" id="imgz" src="/pacsimages/pacs_03/2015/5/9/115050904628-11.jpg" />
	</div>
</body>
<script>

	$(function() {

		$('#accordion').accordion({
			collapsible: true
		});

		$('button').button();

		var caman = Caman('#imgz');

		var rotation = 0;

		function applyFilters() {
			caman.revert(false);

			$('.slider').each(function() {
				var op = $(this).attr('id');
				var value = $(this).data('val');

				if (value === 0) {
					return;
				}

				caman[op](value);
			});
		}

		function resetFilters() {
			$('.slider').each(function() {
				var op = $(this).attr('id');

				$('#' + op).slider('option', 'value', $(this).attr('data-val'));
			});
		}

		$('.slider').each(function() {
			var op = $(this).attr('id');

			$('#' + op).slider({
				min: $(this).data('min'),
				max: $(this).data('max'),
				val: $(this).data('val'),
				change: function(e, ui) {
					$('#v-'+op ).html(ui.value);
					$(this).data('val', ui.value);

					if(e.originalEvent === undefined) {
						return;
					}

					applyFilters();
					caman.render();
				}
			});
		});

		$('#rotate-cw').click(function() {
			rotation += 90;
			caman.rotate(90);
			applyFilters();
			caman.render();
		});

		$('#rotate-ccw').click(function() {
			rotation -= 90;
			caman.rotate(-90);
			applyFilters();
			caman.render();
		});

		$('#resize').click(function() {
			caman.resize({
				width: $('#resize-w').val(),
				height: $('#resize-h').val()
			});
			applyFilters();
			caman.render();
		});

		$('#crop').click(function() {
			caman.crop(
				$('#crop-w').val(),
				$('#crop-h').val(),
				$('#crop-x').val(),
				$('#crop-y').val()
			);
			applyFilters();
			caman.render();
		});

		$('.preset').click(function() {
			resetFilters();
			var preset = $(this).data('preset');
			caman.revert(true);
			caman[preset]();
			caman.render();
		});

		$('#reset').click(function() {
			caman.reset();
			caman.render();
			resetFilters();
		});

		$('#save').click(function() {
			window.open(caman.toBase64());
		});

	});
</script>
</html>