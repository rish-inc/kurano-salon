const datas = document.querySelectorAll ( '.js-handdraw-data' );
datas.forEach( ( data, index ) => {
	let selectors = document.querySelectorAll( '#handDraw_customer_data_report' + index );
	selectors.forEach( selector => {
		selector.innerHTML = `<section class="inner">
			<ul class="ui-set">
				<li>
					<label class="form-check-label">
						<input class="form-type-select" type="radio" name="mode`+index+`" value="1" checked>
						<i class="fa-solid fa-pen"></i>
						ペン
					</label>
				</li>
				<li>
					<label class="form-check-label">
						<input class="form-type-select" type="radio" name="mode`+index+`" value="2">
						<i class="fa-solid fa-eraser"></i>
						消しゴム
					</label>
				</li>
				<li class="pen-size">
					<i class="fa-solid fa-circle"></i>
					<input id="brush-size-range`+index+`" type="range" class="form-weight-range" min="1" max="20" value="4"></input>
					<span id="brush-size`+index+`" class="brush-size-num">4</span>
				</li>
			</ul>
			<article id="canvas-area`+index+`" width="100%" class="canvas-wrapper">
				<canvas id="imageCanvas`+index+`" class="image-canvas"></canvas>
				<canvas id="drawCanvas`+index+`" class="draw-canvas"></canvas>
				<canvas id="tempCanvas`+index+`" class="draw-temp-canvas"></canvas>
				<canvas id="pointerCanvas`+index+`" class="ponter-canvas"></canvas>
				<dialog id="clear-modal`+index+`" class="dialog-clear">
					<p>削除しても良いですか？</p>
					<div id="clear-modal-form`+index+`" class="dialog-clear__buttons" method="dialog">
						<button id="clearCancel`+index+`" class="clear-no" type="cancel">キャンセル</button>
						<button id="clearConfirm`+index+`" class="clear-ok">削除</button>
					</div>
				</dialog>
			</article>
			<ul class="ui-set">
				<li>
					<button id="undo`+index+`" class="button-undo">
						<i id="undoMark`+index+`" class="fa-solid fa-arrow-rotate-left"></i>
						<span>戻す</span>
					</button>
				</li>
				<li>
					<button id="redo`+index+`" class="button-redo">
						<i id="redoMark`+index+`" class="fa-solid fa-arrow-rotate-right"></i>
						<span>進む</span>
					</button>
				</li>
				<li class="right">
					<button id="clear`+index+`" class="button-clear">
						<i id="clearMark`+index+`" class="fa-solid fa-trash"></i>
						<span>削除</span>
					</button>
				</li>
			</ul>
		</section>`;
	} );
} );
