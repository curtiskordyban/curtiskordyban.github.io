var squares = [];
var buttons = [];
var timerId = 0;
var auto = false;
var darkColor = "#FFFAF0";
var lightColor = "#8B6742";
var thinBoarder = "gray";
var data = {};
var options = {};
var ajaxCall = {}; 
var timerCallRate = 50;

$(document).ready(function () 
{ 
    GetGameboard();
    RenderBoard();
    MakePattern(); 
    QueryTimer(true);

});

function DisplayPiece(location, type, color, moveTo)
{   
    // Get and Clear Divs
    var div = document.getElementById(squares[location].id);
    document.getElementById(squares[location].id).innerText = "";

    // Declare Image Element
    var elem = document.createElement("img");
        elem.setAttribute("height", "90");
        elem.setAttribute("width", "90");
   
    // Add Chesspieces to board
    if(type != "X" && moveTo != "Yes")
    {
        elem.setAttribute("src", "images/"+type+"_"+color+".png");
        document.getElementById(squares[location].id).appendChild(elem);
    }

    // Display possible moves
    if(moveTo == "Yes") 
    {
        elem.setAttribute("src", "images/1.png");
        document.getElementById(squares[location].id).appendChild(elem);
    }
    

};
function Test()
{
    console.log(this.id);

}
function RenderBoard()
{   

    var board = document.getElementById("board");

    function AddRows(rows, cols) 
    {
        board.style.setProperty('--grid-rows', rows);
        board.style.setProperty('--grid-cols', cols);

        for (var c = 0; c < (rows * cols); c++) 
        {
            let cell = document.createElement("div");
            cell.id = c;
            cell.onclick = Test;
            board.appendChild(cell).className = "grid-item";
            squares[c] = cell;
        }
            
    };
    AddRows(8, 8);
};
function MakePattern()
{
    var board = document.getElementById("board");
    board.style.backgroundColor = thinBoarder;

    var flip = true;
    for(i = 0; i < 64; i++)
    {
        var div = document.getElementById(squares[i].id);
    
        if(i % 8 == 0)
            flip = !flip;

        if(flip)
            div.style.backgroundColor = lightColor;
        else
            div.style.backgroundColor = darkColor;

        flip = !flip;
    }
 
}
function QueryTimer(running)
{   
    if(running)
        timerID = window.setInterval(GetGameboard, timerCallRate);

};

function GetGameboard()
{
    var postData = {};
        postData["action"] = "GetGameboard";
        AjaxCaller("/~kordyban/cmpe2500/Chessboard/webservice.php",
                    "GET", "JSON", postData, DisplayPieces, errorCallback); 


        //Dump( postData )

};
function DisplayPieces( returnedData, returnedStatus, jqObject )
{
    MakePattern();

    for(var i = 0; i < 64; i++)  
    {
        DisplayPiece(i, returnedData['data'][i]['type'],
                        returnedData['data'][i]['color'],   
                        returnedData['data'][i]['moveTo'])
                     
    }      
    
};

function AjaxCaller(url, method, returnDataType, inputData, 
    successCallback, errorCallback)
{
    var options = {};
    options["url"] = url;
    options["type"] = method;
    options["dataType"] = returnDataType;
    options["data"] = inputData;
    options["success"] = successCallback;
    options["error"] = errorCallback;
    
    $.ajax( options );
};

function successCallback( returnedData, returnedStatus, jqObject )
{
      //Want to make a call and get data back from users
        Dump(returnedData);

        $("#status").html( "Retrieved "+returnedData['status'] );

        console.log(returnedStatus);

};

function errorCallback( jqObject, returnedStatus, errorThrown ) 
{
    console.log("Failure has ensued! " + errorThrown + " : " + returnedStatus);
};

function Dump( jsonObject )
{
    console.log( jsonObject );
    // using "in" to iterate JSON properties, then [prop_name] access example
    for( prop_name in jsonObject ) 
    {
        console.log( 'Property : ' + prop_name + " = " + jsonObject[prop_name]);

    } 
    console.log(jsonObject[prop_name]);
}

   // array = []
    // for(var i = 0; i < 65; i++)
    //     array[i] = i;
    // data = [];
    // for(let i = 0; i < array.length; i++) {
    //     data.push({ squareID : `${array[i]}` });
    // }
    // var postData = {};
    // postData["action"] = "DisableValidMoves2";
    // postData["array"] = data;
    // AjaxCaller("/~kordyban/cmpe2500/Chessboard/webservice.php",
    // "POST", "JSON", postData, successCallback, errorCallback); 


    // var postData = {};
    // postData["action"] = "EnableValidMoves";
    // postData["pos1"] = 2;
    // postData["pos2"] = 22;
    // postData["pos3"] = 6;
    // postData["pos4"] = 8;
    // postData["pos5"] = 15;
    // AjaxCaller("/~kordyban/cmpe2500/Chessboard/webservice.php",
    // "POST", "JSON", postData, successCallback, errorCallback);