/**
 * Social Share Buttons - copy URL button functionality to copy current post/page url on click (on front-end)
 */
export function socialShareButtonsBlockFront() {
  const socialShareButtons = document.querySelectorAll('.wp-block-blocksplus-social-share-buttons-block__link');

  if (socialShareButtons.length > 0) {
    socialShareButtons.forEach(button => {
      if (button.classList.contains('shareurl')) {
        button.addEventListener("click", function (event) {
          event.preventDefault();
          console.log(event.target);
          navigator.clipboard.writeText(event.target.getAttribute('href'));
        });
      }
    });
  }
}
