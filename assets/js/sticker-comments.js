jQuery( document ).ready(function($) {
    $("textarea#comment").emojioneArea({
        hideSource: true,
        tones: false,
        search: false,
        sprite: false
      });
      $("#buddypress #whats-new-form textarea").emojioneArea({
        hideSource: true,
        tones: false,
        search: false,
        sprite: false
      });
});