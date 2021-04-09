import $ from 'jquery';

class Search {
  // 1. describe and initiate object
  constructor() {
    /**
     * To avoid losing the this context when the methods are called
     * as a callbacks to the respond of jquery events
     * we need to bind the context on the initiation step
     */
    this.openOverlay = this.openOverlay.bind(this);
    this.closeOverlay = this.closeOverlay.bind(this);
    this.keyPressDispatcher = this.keyPressDispatcher.bind(this);
    this.typingLogic = this.typingLogic.bind(this);
    this.getSearchResults = this.getSearchResults.bind(this);

    /**
     * Cache DOM elements as accessing a JavaScript variable
     * is much faster than searching the DOM
     */
    this.openButton = $('.js-search-trigger');
    this.closeButton = $('.search-overlay__close');
    this.searchOverlay = $('.search-overlay');
    this.searchField = $('#search-term');
    this.searchResults = $('.search-overlay__results');

    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousSearchValue;
    this.typingTimer;

    this.events();
  }

  // 2. events
  events() {
    this.openButton.click(this.openOverlay);
    this.closeButton.click(this.closeOverlay);
    $(document).on('keydown', this.keyPressDispatcher);
    this.searchField.on('keyup', this.typingLogic);
  }

  // 3. methods
  openOverlay() {
    console.log('Open overlay');

    this.searchOverlay.addClass('search-overlay--active');
    $('body').addClass('body-no-scroll');

    this.isOverlayOpen = true;
  }

  closeOverlay() {
    console.log('Close overlay');

    this.searchOverlay.removeClass('search-overlay--active');
    $('body').removeClass('body-no-scroll');

    this.isOverlayOpen = false;
  }

  keyPressDispatcher(event) {
    switch (event.keyCode) {
      case 83:
        if (!this.isOverlayOpen && !$('input, textarea').is(':focus'))
          this.openOverlay();
        break;
      case 27:
        if (this.isOverlayOpen) this.closeOverlay();
        break;
      default:
        break;
    }
  }

  typingLogic() {
    /**
     * To avoid triggering the requests to the server
     * when arrow keys (or other keys which don't actually change the value of the input)
     * are pressed, we need to check if the value is the same as the saved one
     */
    if (this.searchField.val() === this.previousSearchValue) return;

    clearTimeout(this.typingTimer);

    /**
     * If the search value is empty, we don't want to send
     * unnecessary rewuests to the server
     */
    if (!this.searchField.val()) {
      this.searchResults.html('');
      this.isSpinnerVisible = false;

      return;
    }

    /**
     * We don't want to reset spinner on every keystroke
     * as it leads to flickering.
     * To avoid that, we insert it only if it's not inserted before
     */
    if (!this.isSpinnerVisible) {
      this.searchResults.html('<div class="spinner-loader"></div>');
      this.isSpinnerVisible = true;
    }

    this.typingTimer = setTimeout(this.getSearchResults, 2000);

    /**
     * We'll need to do comparisons between the previous value and the new value
     * So we need to store it in some way
     */
    this.previousSearchValue = this.searchField.val();
  }

  getSearchResults() {
    this.searchResults.html('Searhc results');
    this.isSpinnerVisible = false;
  }
}

export default Search;
