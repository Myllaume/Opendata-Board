const popovers = document.querySelectorAll('[data-toggle="popover"]');
console.log(popovers);
popovers.forEach(popover => {
    Popper.createPopper(popover, tooltip, {
        placement: 'right',
      });
});