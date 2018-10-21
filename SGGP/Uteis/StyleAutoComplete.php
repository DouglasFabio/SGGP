 <style>

    .autocomplete {
      /*the container must be positioned relative:*/
      position: relative;
      display: inline-block;
        
    }


    .autocomplete-items {
      position: static;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: none;
      z-index: 5;
      /*position the autocomplete items to be the same width as the container:*/
      top: 100%;
      left: 0;
      right: 0;

    }

    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff; 
      border-bottom: 1px solid #d4d4d4; 
        
    }

    .autocomplete-items div:hover {
      /*when hovering an item:*/
      background-color: #e9e9e9; 
        
    }

    .autocomplete-active {
      /*when navigating through the items using the arrow keys:*/
      background-color: DodgerBlue !important; 
      color: #ffffff; 
        
    }

</style>