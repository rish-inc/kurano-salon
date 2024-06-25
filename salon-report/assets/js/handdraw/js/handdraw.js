/*
 * Hand draw logic
 */

	const updateButton = document.querySelector( '.editor-post-publish-button' );
	const BGIMG          = path + '/salon-report/assets/js/handdraw/img/human.webp';
	let mode  = 1; //1:pen 2:eraser
	const canvas = {
		width: 500,
		height: 350
	}
	const colorFalse = "#333";
	let imageData;
	const undoMax   = 10;
	const undoData  = [];
	const redoData  = [];
	let offsetX, offsetY;

	let option = {
		holdClick  : false,
		brushSize  : 4,
		strokeColor: 'rgba(0, 0, 0, 1)',
		startX     : 0,
		startY     : 0
	}

	let brushSizeChange = ( num, index ) => {
		document.getElementById( 'brush-size' + index ).innerHTML = num;
		option.brushSize = num;
	}

	datas.forEach( ( data, index ) => {
		const imageCanvas        = document.getElementById( 'imageCanvas' + index );
		const drawCanvas         = document.getElementById( 'drawCanvas' + index );
		const tempCanvas         = document.getElementById( 'tempCanvas' + index );
		const pointerCanvas      = document.getElementById( 'pointerCanvas' + index );
		const undoMark           = document.getElementById( 'undoMark' + index );
		const redoMark           = document.getElementById( 'redoMark' + index );
		const clearMark          = document.getElementById( 'clearMark' + index );
		const brushSizeRange     = document.getElementById( 'brush-size-range' + index );
		const clearButton        = document.getElementById( 'clear' + index );
		const clearModal         = document.getElementById( 'clear-modal' + index );
		const clearCancelButton  = document.getElementById( 'clearCancel' + index );
		const clearConfirmButton = document.getElementById( 'clearConfirm' + index );
		const clearModalForm     = document.getElementById( 'clear-modal-form' + index );
		const undoButton         = document.getElementById( 'undo' + index );
		const redoButton         = document.getElementById( 'redo' + index );
		clearButton.disabled     = true;
		undoButton.disabled      = true;
		redoButton.disabled      = true;
		document.querySelector( '#customer_data' + index ).classList.remove( 'closed' );

		const ctxs = {
			imageCtx   : imageCanvas.getContext( "2d" ),
			drawCtx    : drawCanvas.getContext( "2d", { willReadFrequently: true } ),
			drawTempCtx: tempCanvas.getContext( "2d" ),
			pointerCtx : pointerCanvas.getContext( "2d" )
		}

		let zoom = () => {
			let displayWidth  = drawCanvas.clientWidth;
			let displayHeight = drawCanvas.clientHeight;
			// Check to Buffer size and display size for responsive.
			if ( drawCanvas.width != displayWidth || drawCanvas.height != displayHeight ) {
				imageCanvas.width     = displayWidth;
				imageCanvas.height    = displayHeight;
				drawCanvas.width      = displayWidth;
				drawCanvas.height     = displayHeight;
				tempCanvas.width      = displayWidth;
				tempCanvas.height     = displayHeight;
				pointerCanvas.width   = displayWidth;
				pointerCanvas.height  = displayHeight;
			}
		}

		let buttonStatusToggle = () => {
			imageData = ctxs.drawCtx.getImageData( 0, 0, drawCanvas.width, drawCanvas.height );
			const data = imageData.data;
			const dataReduce = data.reduce( function ( prev, current, i, arr ) { return prev + current } );

			if( dataReduce || data ) {
				clearButton.disabled = false;
				clearMark.style.color = colorFalse;
				return false;
			} else {
				clearButton.disabled = true;
				clearMark.style.color = null;
				return true;
			}
		}

		if ( imageCanvas.getContext && drawCanvas.getContext && tempCanvas.getContext && pointerCanvas.getContext ) {
			window.addEventListener( 'load', function ( e ) {
				image( canvas );
				loadImg();
				pointerCanvas.addEventListener( 'mousedown',  mouseDown );
				pointerCanvas.addEventListener( 'touchstart', mouseDown );
				pointerCanvas.addEventListener( 'mousemove',  mouseMove );
				pointerCanvas.addEventListener( 'touchmove',  touchCheck );
				pointerCanvas.addEventListener( 'mouseup',    mouseUp );
				pointerCanvas.addEventListener( 'touchend',   ( e ) => { e.preventDefault(); mouseUp } );

				pointerCanvas.addEventListener( 'mouseout', ( e ) => {
					ctxs.pointerCtx.clearRect( 0, 0, imageCanvas.width, imageCanvas.height );
					if ( option.holdClick ) mouseUp( e, ctxs );
				} );
				zoom();
				buttonStatusToggle;
				if ( updateButton ) updateButton.addEventListener( 'click', ( e ) => saveImg( e ) );
			} );
			window.addEventListener( 'resize', zoom() );
			window.addEventListener( 'change', () => {
				mode = Number( document.querySelector( 'input[name="mode' + index + '"]:checked' ).value );
			} );
			brushSizeRange.addEventListener( 'change', ( e ) =>  {
				brushSizeChange( e.target.value, index );
			} );
			undoButton.addEventListener(  'click', () => undo() );
			redoButton.addEventListener(  'click', () => redo() );
			clearButton.addEventListener( 'click', () => clear() );
		}

		let mouseDown = ( e ) => {
			let offsets = getOffsets( e, ctxs );
			option.holdClick = true;
			option.startX = offsets.x;
			option.startY = offsets.y;
			redoReset();
			undoStack();
		}

		let getOffsets = ( e ) => {
			const rect = e.target.getBoundingClientRect();
			let offsets = {
				x: 0,
				y: 0
			};
			if ( e.touches ) {
				offsets.x = Math.floor( e.touches[0].clientX - rect.left );
				offsets.y = Math.floor( e.touches[0].clientY - rect.top );
			} else {
				offsets.x = e.offsetX;
				offsets.y = e.offsetY;
			}
			return offsets;
		}
		let touchCheck = ( e ) => {
			if ( e.touches.length <= 1 ) {//One finger tap
				mouseMove( e );
			} else if (e.touches.length >= 2 ) {//Two finger tap
				return;
			}
		}

		let mouseMove = ( e ) => {
			pointer( e );
			e.preventDefault();
			if ( mode === 1 ) {
				if ( option.holdClick ) {
					drawPen( e );
				}
			} else if ( mode === 2 ) {
				pointer( e );
				if ( option.holdClick ) {
					drawErase( e );
				}
			}
		}

		let mouseUp = ( e ) => {
			option.holdClick = false;
			if ( mode === 1 ) {
				drawPen( e );
			} else if ( mode === 2 ) {
				drawErase( e );
			}
		}

		let drawPen = ( e ) => {
			let offsets = getOffsets( e );
			ctxs.drawCtx.lineWidth   = option.brushSize;
			ctxs.drawCtx.strokeStyle = option.strokeColor;
			ctxs.drawCtx.lineJoin    = "round";
			ctxs.drawCtx.lineCap     = "round";
			ctxs.drawCtx.globalCompositeOperation = 'source-over';
			ctxs.drawCtx.beginPath();
			ctxs.drawCtx.moveTo( option.startX, option.startY );
			ctxs.drawCtx.lineTo( offsets.x, offsets.y );
			ctxs.drawCtx.stroke();
			ctxs.drawCtx.closePath();
			option.startX = offsets.x;
			option.startY = offsets.y;
			buttonStatusToggle();
		}

		let drawErase = ( e ) => {
			let offsets = getOffsets( e );
			ctxs.drawCtx.lineWidth   = option.brushSize;
			ctxs.drawCtx.strokeStyle = 'rgba( 255, 255, 255, 1 )';
			ctxs.drawCtx.globalCompositeOperation = 'destination-out';
			ctxs.drawCtx.beginPath();
			ctxs.drawCtx.moveTo( option.startX, option.startY );
			ctxs.drawCtx.lineTo( offsets.x, offsets.y );
			ctxs.drawCtx.stroke();
			ctxs.drawCtx.closePath();
			option.startX = offsets.x;
			option.startY = offsets.y;
		}

		let pointer = ( e ) => {
			let offsets = getOffsets( e );
			ctxs.pointerCtx.clearRect( 0, 0, imageCanvas.width, imageCanvas.height );
			if ( mode === 2 ) {
				ctxs.pointerCtx.strokeStyle = "rgba( 221, 221, 221, 1 )";
			} else {
				ctxs.pointerCtx.strokeStyle = option.strokeColor;
			}
			ctxs.pointerCtx.lineWidth = option.brushSize;
			ctxs.pointerCtx.lineCap = "round";
			ctxs.pointerCtx.beginPath();
			ctxs.pointerCtx.moveTo( offsets.x, offsets.y );
			ctxs.pointerCtx.lineTo( offsets.x, offsets.y );
			ctxs.pointerCtx.stroke();
			ctxs.pointerCtx.closePath();
		}

		let undoStack = () => {
			imageData = ctxs.drawCtx.getImageData( 0, 0, drawCanvas.width, drawCanvas.height );
			if ( undoData.length >= undoMax ) undoData.shift();
			undoData.push( imageData );
			undoButton.disabled = false;
			undoMark.style.color = '#333';
		}

		let redoStack = () => {
			imageData = ctxs.drawCtx.getImageData( 0, 0, drawCanvas.width, drawCanvas.height );
			if ( redoData.length >= undoMax ) redoData.shift();
			redoData.push( imageData );
			redoButton.disabled = false;
			redoMark.style.color = '#333';
		}

		let undo = () => {
			if ( undoData.length > 0 ) {
				redoStack();
				ctxs.drawCtx.putImageData( undoData.pop(), 0, 0 );
				if( ! undoData.length ) {
					undoButton.disabled = true;
					undoMark.style.color = null;
				}
			}
			buttonStatusToggle();
		}

		let redo = () => {
			if ( redoData.length > 0 ) {
				undoStack();
				ctxs.drawCtx.putImageData( redoData.pop(), 0, 0 );
				if( ! redoData.length ) {
					redoButton.disabled = true;
					redoMark.style.color = null;
				}
			}
			buttonStatusToggle();
		}

		let redoReset = () => {
			redoData.length = 0;
			redoMark.style.color = null;
		}

		let clear = () => {
			clearModal.showModal();
			clearConfirmButton.addEventListener( 'click', clearConfirm );
			clearCancelButton.addEventListener(  'click', () => clearModal.close() );
		}

		let clearConfirm = () => {
			undoStack();
			ctxs.drawCtx.clearRect( 0, 0, drawCanvas.width, drawCanvas.height );
			ctxs.drawTempCtx.clearRect( 0, 0, tempCanvas.width, tempCanvas.height );
			ctxs.pointerCtx.clearRect( 0, 0, pointerCanvas.width, pointerCanvas.height );
			buttonStatusToggle( ctxs );
			clearModal.close();
		}

		let saveImg = ( e ) => {
			if ( buttonStatusToggle() ) {
				e.preventDefault();
			} else {
				let date = new Date;
				let timestamp = Math.floor( date.getTime() / 1000 );
				let img = drawCanvas.toDataURL( "image/png" );
				data.value = img;
			}
		}

		let loadImg = async ( e ) => {
			const dataImg = data.value;
			const img = new Image( canvas.width, canvas.height );
			img.onload = () => {
				ctxs.drawCtx.drawImage( img, 0, 0, canvas.width, canvas.height );
			}
			img.src = dataImg;
		}

		let image = ( canvas ) => {
			const img = new Image( canvas.width, canvas.height );
			img.src = BGIMG;
			img.addEventListener( "load", () => ctxs.imageCtx.drawImage( img, 0, 0, canvas.width, canvas.height, 0, 0, canvas.width, canvas.height ) );
		}

		//Load human image to background-image
	} );

	// let togglePostbox = () => {
	// 	const postboxes = document.querySelectorAll( '.postbox' );
	// 	postboxes.forEach( ( postbox, index ) => {
	// 		let getTime = postbox.querySelector( 'input[name="customer_visit_datetime_customer_data_report' + index + '"]' );
	// 		if ( getTime ) {
	// 			document.querySelector( '#customer_data' + index ).classList.add( 'closed' );
	// 			if ( getTime.value !== null && getTime.value !== '' ) {
	// 				document.querySelector( '#customer_data' + index ).classList.remove( 'closed' );
	// 				// postbox.querySelector( '.handlediv' ).ariaExpanded = 'false';
	// 			} else {
	// 				// document.querySelector( '#customer_data' + index ).classList.add( 'closed' );
	// 				// postbox.querySelector( '.handlediv' ).ariaExpanded = 'true';
	// 			}
	// 		}
	// 	} );
	// }
	// togglePostbox();

