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

    this.openButton = $('.js-search-trigger');
    this.closeButton = $('.search-overlay__close');
    this.searchOverlay = $('.search-overlay');
    this.events();
  }

  // 2. events
  events() {
    this.openButton.click(this.openOverlay);
    this.closeButton.click(this.closeOverlay);
  }

  // 3. methods
  openOverlay() {
    this.searchOverlay.addClass('search-overlay--active');
    $('body').addClass('body-no-scroll');
  }

  closeOverlay() {
    this.searchOverlay.removeClass('search-overlay--active');
    $('body').removeClass('body-no-scroll');
  }
}

export default Search;
