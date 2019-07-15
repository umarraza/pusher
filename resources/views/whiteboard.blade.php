<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>White Board</title>

    <link href="{{ asset('/public/css/screen.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="{{ asset('/public/js/screen.js') }}"></script>

</head>
<body>
    
	<zwibbler showToolbar="false" pageView="true" defaultPaperSize="letter landscape">
      <div class="tools">
			<div>
				
				<button tool z-on:click="usePickTool()" title="Select" z-class="{selected:getCurrentTool()=='pick'}">
            	<i class="fa fa-mouse-pointer"></i>
				 </button> 
				 
          	<button tool z-on:click="useBrushTool()" title="Draw" z-class="{selected:getCurrentTool()=='brush'}">
            	<i class="fa fa-pencil"></i>
          	</button>
				 
				<button tool z-click="useLineTool()" title="Lines" z-class="{selected:getCurrentTool()=='line'}">
					<i class="fa fa-window-minimize"></i>
          	</button>
			 
			 	<button tool z-click="useRectangleTool()" title="Rectangle" z-class="{selected:getCurrentTool()=='rectangle'}">
					<i class="fa fa-square"></i>
			 	</button>
			 
          	<button tool z-click="useCircleTool()" title="Circle" z-class="{selected:getCurrentTool()=='circle'}">
					<i class="fa fa-circle"></i>
			 	</button>
			 
          	<button tool z-click="useTextTool()" title="Text" z-class="{selected:getCurrentTool()=='text'}">
					<i class="fa fa-font"></i>
			 	</button>
			 
				<button tool z-click="insertImage()" title="Insert image">
					<i class="fa fa-image"></i>
				</button>
				
				<button tool z-click="cut()" title="Cut">
					<i class="fa fa-scissors"></i>
				</button>
				
				<button tool z-click="copy()" title="Copy">
					<i class="fa fa-files-o"></i>
				</button>
				
				<button tool z-click="paste()" title="Paste">
					<i class="fa fa-clipboard"></i>
				</button>
				
				<button tool z-click="undo()" z-disabled="!canUndo()">
					<i class="fa fa-undo"></i>
				</button>
				
				<button tool z-click="redo()" z-disabled="!canRedo()">
					<i class="fa fa-arrow-circle-left"></i>
				</button>
				
				<button tool z-click="zoomIn()">
					<i class="fa fa-search-plus"></i>
				</button>
				
				<button tool z-click="setZoom('page')">
					<i class="fa fa-arrows-alt"></i>
				</button>
				
				<button tool z-click="zoomOut()">
					<i class="fa fa-search-minus"></i>
				</button>
			</div>
		
		<button z-click="Download" z-show-popup="my-menu">Download</button>
        <div z-has="AnyNode">
          <h3>Shape options</h3>
          <button z-click="deleteNodes()">Delete</button>                    
          <button z-click="bringToFront()">
            Move to front
          </button>
          <button z-click="sendToBack()">
            Send to back
          </button>
        </div>
        <div z-has="fontName">
          <h4>Font</h4>
          <select z-property="fontName">
            <option>Arial</option>
            <option>Times New Roman</option>
          </select>
        </div>
        <div z-has="fontSize">
          <h4>Font size</h4>
          <select z-property="fontSize">
            <option>8</option>
            <option>10</option>
            <option>12</option>
            <option>18</option>
            <option>24</option>
            <option>50</option>
          </select>
        </div>
        <div z-has="fillStyle">
          <h3>Colours</h3>
          <div class="colour-picker" z-has="fillStyle">
            <div swatch z-property="fillStyle" z-colour></div>
            Fill style
          </div>
          <div class="colour-picker" z-has="strokeStyle">
            <div swatch z-property="strokeStyle" z-colour></div>
            Outline
          </div>
          <div class="colour-picker" z-has="background">
            <div swatch z-property="background" z-colour></div>
            Background
          </div>
        </div>
        <div z-has="arrowSize">
          <h3>Arrows</h3>
          <button class="option" z-property="arrowSize" z-value="0">None</button>
          <button class="option" z-property="arrowSize" z-value="10">Small</button>
          <button class="option" z-property="arrowSize" z-value="15">Large</button>
          <hr>
          <button class="option" z-property="arrowStyle" z-value="solid">Solid</button>
          <button class="option" z-property="arrowStyle" z-value="open">Open</button>
        </div>
        <div z-has="lineWidth">
          <h3>Line width</h3> 
          <select z-property="lineWidth">
            <option value="0">None</option>
            <option>1</option>
            <option>2</option>
            <option>4</option>
            <option>8</option>
          </select>
        </div>
        <div z-has="dashes">
          <h3>Line style</h3>
          <button class="option" z-property="dashes" z-value="">Solid</button>
          <button class="option" z-property="dashes" z-value="3,3">Dots</button>
          <button class="option" z-property="dashes" z-value="8,2">Dashes</button>
        </div>
        <div z-has="opacity">
          <h3>Opacity</h3>
          <input z-property="opacity" type="range" min="0.1" max="1.0" step="0.05">
        </div>              
      </div>
      <div style="display:flex;flex-flow:column;flex: 1 1 auto;min-width:0">
        <div z-canvas></div>
        <div class="pages">
          <button title="Insert page" z-click="insertPage()"><i class="fa fa-plus"></i></button>
          <button title="Delete page" z-click="deletePage()"><i class="fa fa-minus"></i></button>
          <div z-for="mypage in getPageCount()">
            <div z-page="mypage" 
                 z-height="70"
                 class="page"
                 z-class="{selected: mypage==getCurrentPage()}"
                 z-click="setCurrentPage(mypage)"></div>
          </div>
        </div>
      </div>
      <div z-popup="my-menu">
        <button z-click="download('png', 'drawing.png')">PNG</button>
        <button z-click="download('jpg', 'drawing.jpg')">JPG</button>
        <button z-click="download('svg', 'drawing.svg')">SVG</button>
        <button z-click="download('pdf', 'drawing.pdf')">PDF</button>
      </div>
    </zwibbler>
    <script>
      Zwibbler.enableConsoleLogging();
 
    </script>
</body>
</html>