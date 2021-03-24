String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

function scrollToTopOfWindow() {
    window.scrollTo({top: 0, behavior: 'smooth'});
}