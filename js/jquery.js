$(function(){
	//モーダルウィンドウを出現させるクリックイベント
	$(".button-link").click(function(){
		//キーボード操作などにより、オーバーレイが多重起動するのを防止する
		$( this ).blur() ;	//ボタンからフォーカスを外す
		if( $( "#modal-overlay" )[0] ) return false ;		//新しくモーダルウィンドウを起動しない (防止策1)
		//if($("#modal-overlay")[0]) $("#modal-overlay").remove() ;		//現在のモーダルウィンドウを削除して新しく起動する (防止策2)

		//オーバーレイを出現させる
		$( "body" ).append( '<div id="modal-overlay"></div>' ) ;
		$( "#modal-overlay" ).fadeIn( "slow" ) ;

		//コンテンツをセンタリングする
		centeringModalSyncer() ;

		if(this.getAttribute( "data-target" ) =="modal-incorrect") {
			//コンテンツをフェードインする
			$( "#modal-incorrect" ).fadeIn( "slow" ) ;

			//[#modal-overlay]、または[#modal-close]をクリックしたら…
			$( "#modal-overlay,#modal-close" ).unbind().click( function(){

				//[#]と[#modal-overlay]をフェードアウトした後に…
				$( "#modal-incorrect,#modal-overlay" ).fadeOut( "slow" , function(){

					//[#modal-overlay]を削除する
					$('#modal-overlay').remove() ;
					window.location.href = 'question.php';

				} ) ;

			} ) ;
		} else {
			//コンテンツをフェードインする
			$( "#modal-correct" ).fadeIn( "slow" ) ;

			//[#modal-overlay]、または[#modal-close]をクリックしたら…
			$( "#modal-overlay,#modal-close" ).unbind().click( function(){

				//[#]と[#modal-overlay]をフェードアウトした後に…
				$( "#modal-correct,#modal-overlay" ).fadeOut( "slow" , function(){

					//[#modal-overlay]を削除する
					$('#modal-overlay').remove() ;
					window.location.href = 'question.php';

				})
			})
		}
	} ) ;

	//リサイズされたら、センタリングをする関数[centeringModalSyncer()]を実行する
	$( window ).resize( centeringModalSyncer ) ;

	//センタリングを実行する関数
	function centeringModalSyncer() {

		//画面(ウィンドウ)の幅、高さを取得
		var w = $( window ).width() ;
		var h = $( window ).height() ;

		// コンテンツ(#modal-incorrect)の幅、高さを取得
		// jQueryのバージョンによっては、引数[{margin:true}]を指定した時、不具合を起こします。
		//		var cw = $( "#modal-incorrect" ).outerWidth( {margin:true} );
		//		var ch = $( "#modal-incorrect" ).outerHeight( {margin:true} );
		var cw = $( "#modal-incorrect" ).outerWidth();
		var ch = $( "#modal-incorrect" ).outerHeight();

		//センタリングを実行する
		$( "#modal-incorrect" ).css( {"left": ((w - cw)/2) + "px","top": ((h - ch)/2) + "px"} ) ;
		$( "#modal-correct" ).css( {"left": ((w - cw)/2) + "px","top": ((h - ch)/2) + "px"} ) ;

	}

});
