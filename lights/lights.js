// Fig. 13.4: draw.js 
// A simple drawing program. 
 //initialization function to insert cells into the table
function createLights()
{
   var side = 4;
   //var tbody = document.getElementById( "tablebody" );
   var str = '';
   //$('#message').html('createLights called!');  
   for ( var r = 0; r < side; r++ )
   {
      //var row = document.createElement( "tr" );
      str = str + '<tr>'; 
      for ( var c = 0; c < side; c++ )
      {
       //  var cell = document.createElement( "td" );
         //row.appendChild( cell );
	 //str = str + '<td id=\"r'+r+'c'+c+'\">r'+r+' c'+c+'</td>';
	 str = str + '<td id=\"r'+r+'c'+c+'\" class=\"on\"></td>';
      } // end for
      str = str + '</tr>';
     // tbody.appendChild( row );
   } // end for
      $('#tablebody').append(str);
   // register mousemove listener for the table
   //document.getElementById( "lights" ).addEventListener( 
   //   "click", processMouseClick, false );
} // end function createCanvas

function resetGame(){
  $('.off').toggleClass('off on');
  $('#message').html('');
  checkWin();
}

function checkWin(){
  //$('#message').html('checkWin called!');
  var win = false;
  var cnt = $('td.on').length;
  if(cnt <= 0){
    win = true;
    $('#message').html('You win!');
  } 
  return win;
}
