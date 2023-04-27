(function($) {
  $.fn.filemanager = function(type, options) {
    type = type || "file";

    this.on("click", function(e) {
      var route_prefix =
        options && options.prefix
          ? options.prefix
          : "/file/laravel-filemanager";
      var target_input = $("#" + $(this).data("input"));
      var target_preview = $("#" + $(this).data("preview"));
      window.open(
        route_prefix + "?type=" + type,
        "FileManager",
        "width=1280,height=600"
      );
      window.SetUrl = function(items) {
        var current_imgs = target_input.val();
        current_imgs = current_imgs ? JSON.parse(target_input.val()) : [];

        var file_path = items.map(function(item) {
          var temp_var = item.url.replace(
            typeof ENV.PUBLIC_URL != "undefined" ? ENV.PUBLIC_URL : "",
            ""
          );
          current_imgs.push({
            url: temp_var,
            thumb_nail: item.thumb_url.replace(
              typeof ENV.PUBLIC_URL != "undefined" ? ENV.PUBLIC_URL : "",
              ""
            )
          });
          return temp_var;
        });

        console.log(current_imgs, file_path);

        // set the value of the desired input to image url
        // target_input.val('').val(file_path).trigger('change');

        target_input
          .val(Array.isArray(current_imgs) ? JSON.stringify(current_imgs) : "")
          .trigger("change");

        // clear previous preview
        // target_preview.html('');

        // set or change the preview image src
        items.forEach(function(item) {
          target_preview.append(
            $("<div>")
              .addClass("wrap-img-opt")
              .append($("<img>").attr("src", item.thumb_url))
              .append(
                $("<i>")
                  .addClass("fa fa-close")
                  .attr("data-input-imgs", target_input.attr("id"))
                  .attr("data-src", item.thumb_url)
              )
          );
        });

        // trigger change event
        target_preview.trigger("change");
      };
      return false;
    });
  };
})(jQuery);
