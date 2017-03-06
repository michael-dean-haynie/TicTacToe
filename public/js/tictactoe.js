function readyUp(){
  $.ajax({
    url: "/ajax/ready-up-quickmatch",
    data: {},
    type: "GET",
    dataType: "json",
  })
  .done(function(json) {
    console.log(json);
    waitInQuickMatchQueue();
  })
}

function un_readyUp(){
  $.ajax({
    url: "/ajax/un-ready-up-quickmatch",
    data: {},
    type: "GET",
    dataType: "json",
  })
  .done(function(json) {
    console.log(json);
    clearInterval(window.quickmatchWait);
  })
}

function waitInQuickMatchQueue(){
  window.quickmatchWait = setInterval(function(){
    $.ajax({
      url: "/ajax/check-for-quickmatch",
      data: {},
      type: "GET",
      dataType: "json",
    })
    .done(function(json) {
      console.log(json);
      if (json.matchFound == true){ // match found!
        clearInterval(window.quickmatchWait);
        window.location = "/playing/online";
      }
    })
  }, 1000);
}












// function readyUp(){

//   $.ajax({
//     url: "/ajax/do-something",
//     data: {
//         id: 123
//     },
//     type: "GET",
//     dataType : "json",
//   })
//   .done(function(json) {
//      console.log(json.response);
//   })
//   .fail(function( xhr, status, errorThrown ) {
//     console.log( "Error: " + errorThrown );
//     console.log( "Status: " + status );
//   })
//   .always(function( xhr, status ) {
//     console.log( "The request is complete!" );
//   });
// }