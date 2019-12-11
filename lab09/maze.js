"use strict";

var loser = null;  // whether the user has hit a wall
var playing = false;

window.onload = function() {
    var boundaries = $$(".boundary");
    for(var i = 0; i < boundaries.length; i++)
    {
        boundaries[i].observe("mouseover", overBoundary);
    }
    $("end").observe("mouseover", overEnd);
    $("start").observe("click", startClick);
    $("start").observe("mouseout", overBody);        
};

// called when mouse enters the walls; 
// signals the end of the game with a loss
function overBoundary(event) {
    if(playing === false) 
    {
        return;
    }

    if(loser === null)
    {
        loser = true;
        $("status").textContent = "You lose! :(";
        var boundaries = $$("#maze .boundary");
        for(var i = 0; i < boundaries.length; i++)
        {
            boundaries[i].addClassName("youlose");
        }
    }

    playing = false;
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
    playing = true;

    loser = null;
    var boundaries = $$(".boundary");
    for(var i = 0; i < boundaries.length; i++)
    {
        boundaries[i].removeClassName("youlose");
    }
    $("status").textContent = "Click the \"S\" to begin.";
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
    if(playing === false) 
    {
        return;
    }

    if(loser === null)
    {
        loser = false;
        $("status").textContent = "You win! :)";
    }

    playing = false;
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
    if(event.offsetX < 0)
    {
        overBoundary();        
    }
}



