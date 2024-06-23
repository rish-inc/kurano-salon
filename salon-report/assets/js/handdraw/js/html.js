const datas = document.querySelectorAll ( '.js-handdraw-data' );
datas.forEach( data => {
	let loop = data.dataset.loop;
	let selectors = document.querySelectorAll( '#handDraw_customer_data_report' + data.dataset.loop );
	selectors.forEach( selector => {
		selector.innerHTML = `<section class="inner">
			<ul class="ui-set">
				<li>
					<label class="form-check-label">
						<input class="form-type-select" type="radio" name="mode" value="1" checked>
						<i class="fa-solid fa-pen"></i>
						ペン
					</label>
				</li>
				<li>
					<label class="form-check-label">
						<input class="form-type-select" type="radio" name="mode" value="2">
						<i class="fa-solid fa-eraser"></i>
						消しゴム
					</label>
				</li>
				<li class="pen-size">
					<i class="fa-solid fa-circle"></i>
					<input id="brush-size-range`+loop+`" type="range" class="form-weight-range" min="1" max="20" value="4"></input>
					<span id="brush-size`+loop+`" class="brush-size-num">4</span>
				</li>
			</ul>
			<article id="canvas-area`+loop+`" width="100%" class="canvas-wrapper">
				<canvas id="imageCanvas`+loop+`" class="image-canvas"></canvas>
				<canvas id="drawCanvas`+loop+`" class="draw-canvas"></canvas>
				<canvas id="tempCanvas`+loop+`" class="draw-temp-canvas"></canvas>
				<canvas id="pointerCanvas`+loop+`" class="ponter-canvas"></canvas>
				<dialog id="clear-modal`+loop+`" class="dialog-clear">
					<p>削除しても良いですか？</p>
					<div id="clear-modal-form`+loop+`" class="dialog-clear__buttons" method="dialog">
						<button id="clearCancel`+loop+`" class="clear-no" type="cancel">キャンセル</button>
						<button id="clearConfirm`+loop+`" class="clear-ok">削除</button>
					</div>
				</dialog>
			</article>
			<ul class="ui-set">
				<li>
					<button id="undo`+loop+`" class="button-undo">
						<i id="undoMark`+loop+`" class="fa-solid fa-arrow-rotate-left"></i>
						<span>戻す</span>
					</button>
				</li>
				<li>
					<button id="redo`+loop+`" class="button-redo">
						<i id="redoMark`+loop+`" class="fa-solid fa-arrow-rotate-right"></i>
						<span>進む</span>
					</button>
				</li>
				<li class="right">
					<button id="clear`+loop+`" class="button-clear">
						<i id="clearMark`+loop+`" class="fa-solid fa-trash"></i>
						<span>削除</span>
					</button>
				</li>
			</ul>
		</section>`;
	} );
} );
