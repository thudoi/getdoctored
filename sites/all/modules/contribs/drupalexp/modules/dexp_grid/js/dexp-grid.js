(function ($) {
  Drupal.behaviors.dexp_grid = {
    attach: function (context, settings) {
      $('.dexp-grid').once('dexp-grid', function () {
        var $grid = $(this).find('.dexp-grid-inner'),
          id = $(this).attr('id'),
          options = settings.dexp_grid_masonry[id];
        $grid.data({
          resize: true,
          sameheight: false
        });
        options.columnWidth = dexp_grid_adjust_column_width(options, $grid);
        var shuffle_options = {
          itemSelector: '.dexp-grid-item',
          speed: 500,
          sizer: $grid.find('.shuffle__sizer')
        };
        $grid.shuffle(shuffle_options).shuffle('shuffle', 'all');
        if ($grid.parent().hasClass('classic')) {
          $grid.on('layout.shuffle', function () {
            var columnNum = 0,
              ww = $(window).width();
            if (ww < 768) {
              columnNum = options.grid_cols_xs;
            } else if (ww >= 768 && ww < 992) {
              columnNum = options.grid_cols_sm;
            } else if (ww >= 992 && ww < 1200) {
              columnNum = options.grid_cols_md;
            } else if (ww >= 1200) {
              columnNum = options.grid_cols_lg;
            }
            if (columnNum < 2) return false;
            if ($grid.data('sameheight')) {
              return false;
            }
            $grid.data('sameheight', true);
            var maxheight = 0;
            $grid.find('.filtered').each(function (index) {
              if ($(this).height() > maxheight) {
                maxheight = $(this).height();
              }
              if (index % columnNum == columnNum - 1 && index > 0) {
                $grid.find(".filtered").slice(index - columnNum + 1, index + 1).css({
                  minHeight: maxheight+1
                });
                maxheight = 0;
              }
            });
            $grid.shuffle('update');
            $grid.find('.filtered').css({
              minHeight: 'auto'
            });
            setTimeout(function(){$grid.data('sameheight', false)},1000);
          });
        }
        $(window).resize(function () {
          if ($grid.data('resize')) {
            $grid.width('auto');
            shuffle_options.columnWidth = dexp_grid_adjust_column_width(options, $grid);
            $grid.shuffle('update');
          }
        });
        $(window).load(function(){
          $grid.shuffle('update');
        });
      });
      $('.grid-filter').once('grid-filter', function () {
        var $grid = $(this).next('.dexp-grid').find('.dexp-grid-inner');
        $(this).find('a').on('click', function (e) {
          e.preventDefault();
          if ($(this).hasClass('active')) return false;
          $grid.css({
            width: $grid.width() + 5
          });
          var $this = $(this),
            filter = $this.data('filter');
          if (filter == '*') {
            $grid.shuffle('shuffle', 'all');
          } else {
            $grid.shuffle('shuffle', function ($el, shuffle) {
              /*Only search elements in the current group*/
              if (shuffle.group !== 'all' && $.inArray(shuffle.group, $el.data('groups')) === -1) {
                return false;
              }
              return $el.hasClass(filter);
            });
          }
          $(this).parents('.dexp-grid-filter').find('a').removeClass('active');
          $(this).addClass('active');
          return false;
        });
      });
    }
  }

  var dexp_grid_adjust_column_width = function (options, $grid) {
    var ww = $(window).width(),
      columnNum = 0,
      columnWidth = 0;
    if (ww < 768) {
      columnNum = options.grid_cols_xs;
    } else if (ww >= 768 && ww < 992) {
      columnNum = options.grid_cols_sm;
    } else if (ww >= 992 && ww < 1200) {
      columnNum = options.grid_cols_md;
    } else if (ww >= 1200) {
      columnNum = options.grid_cols_lg;
    }
    var columnWidth = Math.ceil(($grid.width() - (columnNum - 1) * options.grid_margin) / columnNum);
    var columnHeight = Math.ceil(columnWidth / options.grid_ratio);
    $grid.find('.shuffle__sizer').css({
      width: columnWidth,
      margin: options.grid_margin
    });
    $grid.css({
      width: $grid.width() + columnNum
    })
    $grid.find('.dexp-grid-item').each(function (index) {
      if ($grid.parent().hasClass('masonry-resize')) {
        var multiplier_w = $(this).attr('class').match(/item-w(\d)/),
          multiplier_h = $(this).attr('class').match(/item-h(\d)/);
        if (multiplier_w[1] == 0) multiplier_w[1] = 1;
        if (multiplier_h[1] == 0) multiplier_h[1] = 1;
        var item_width = columnNum == 1 ? columnWidth : multiplier_w[1] * columnWidth + (multiplier_w[1] - 1) * options.grid_margin,
          item_height = columnNum == 1 ? columnHeight : multiplier_h[1] * columnHeight + (multiplier_h[1] - 1) * options.grid_margin;
        $(this).css({
          width: item_width,
          height: item_height,
          marginBottom: options.grid_margin
        });
      } else {
        $(this).css({
          width: columnWidth,
          marginBottom: options.grid_margin
        });
      }
    });
    return columnWidth;
  }
})(jQuery)
