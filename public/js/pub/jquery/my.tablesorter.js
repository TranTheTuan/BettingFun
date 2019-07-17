$(function() {

    var $table = $('table');

    $table

    // Initialize tablesorter
    // ***********************
        .tablesorter({
            theme: 'blue',
            widthFixed: true,
            widgets: ['zebra', 'filter', 'pager'],

            widgetOptions: {

                // ** NOTE: All default ajax options have been removed from this demo,
                // see the example-widget-pager-ajax demo for a full list of pager
                // options

                // css class names that are added
                pager_css: {
                    container   : 'tablesorter-pager',    // class added to make included pager.css file work
                    errorRow    : 'tablesorter-errorRow', // error information row (don't include period at beginning); styled in theme file
                    disabled    : 'disabled'              // class added to arrows @ extremes (i.e. prev/first arrows "disabled" on first page)
                },

                // jQuery selectors
                pager_selectors: {
                    container   : '.pager',       // target the pager markup (wrapper)
                    first       : '.first',       // go to first page arrow
                    prev        : '.prev',        // previous page arrow
                    next        : '.next',        // next page arrow
                    last        : '.last',        // go to last page arrow
                    gotoPage    : '.gotoPage',    // go to page selector - select dropdown that sets the current page
                    pageDisplay : '.pagedisplay', // location of where the "output" is displayed
                    pageSize    : '.pagesize'     // page size selector - select dropdown that sets the "size" option
                },

                // output default: '{page}/{totalPages}'
                // possible variables: {size}, {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
                // also {page:input} & {startRow:input} will add a modifiable input in place of the value
                pager_output: '{startRow:input} – {endRow} / {totalRows} rows', // '{page}/{totalPages}'

                // apply disabled classname to the pager arrows when the rows at either extreme is visible
                pager_updateArrows: true,

                // starting page of the pager (zero based index)
                pager_startPage: 0,

                // Reset pager to this page after filtering; set to desired page number
                // (zero-based index), or false to not change page at filter start
                pager_pageReset: 0,

                // Number of visible rows
                pager_size: 10,

                // f true, child rows will be counted towards the pager set size
                pager_countChildRows: false,

                // Save pager page & size if the storage script is loaded (requires $.tablesorter.storage in jquery.tablesorter.widgets.js)
                pager_savePages: true,

                // Saves tablesorter paging to custom key if defined. Key parameter name
                // used by the $.tablesorter.storage function. Useful if you have
                // multiple tables defined
                pager_storageKey: "tablesorter-pager",

                // if true, the table will remain the same height no matter how many records are displayed. The space is made up by an empty
                // table row set to a height to compensate; default is false
                pager_fixedHeight: true,

                // remove rows from the table to speed up the sort of large tables.
                // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
                pager_removeRows: false // removing rows in larger tables speeds up the sort

            }

        })

        // bind to pager events
        // *********************
        .bind('pagerChange pagerComplete pagerInitialized pageMoved', function(e, c) {
            var p = c.pager, // NEW with the widget... it returns config, instead of config.pager
                msg = '"</span> event triggered, ' + (e.type === 'pagerChange' ? 'going to' : 'now on') +
                    ' page <span class="typ">' + (p.page + 1) + '/' + p.totalPages + '</span>';
            $('#display')
                .append('<li><span class="str">"' + e.type + msg + '</li>')
                .find('li:first').remove();
        })

    // Add two new rows using the "addRows" method
    // the "update" method doesn't work here because not all rows are
    // present in the table when the pager is applied ("removeRows" is false)
    // ***********************************************************************
    var r, $row, num = 50,
        row = '<tr><td>Student{i}</td><td>{m}</td><td>{g}</td><td>{r}</td><td>{r}</td><td>{r}</td><td>{r}</td><td><button type="button" class="remove" title="Remove this row">X</button></td></tr>' +
            '<tr><td>Student{j}</td><td>{m}</td><td>{g}</td><td>{r}</td><td>{r}</td><td>{r}</td><td>{r}</td><td><button type="button" class="remove" title="Remove this row">X</button></td></tr>';
    $('button:contains(Add)').click(function() {
        // add two rows of random data!
        r = row.replace(/\{[gijmr]\}/g, function(m) {
            return {
                '{i}' : num + 1,
                '{j}' : num + 2,
                '{r}' : Math.round(Math.random() * 100),
                '{g}' : Math.random() > 0.5 ? 'male' : 'female',
                '{m}' : Math.random() > 0.5 ? 'Mathematics' : 'Languages'
            }[m];
        });
        num = num + 2;
        $row = $(r);
        $table
            .find('tbody').append($row)
            .trigger('addRows', [$row]);
        return false;
    });

    // Delete a row
    // *************
    $table.delegate('button.remove', 'click' ,function() {
        // disabling the pager will restore all table rows
        // $table.trigger('disablePager');
        // remove chosen row
        $(this).closest('tr').remove();
        // restore pager
        // $table.trigger('enablePager');
        $table.trigger('update');
        return false;
    });

    // Destroy pager / Restore pager
    // **************
    $('button:contains(Destroy)').click(function() {
        // Exterminate, annhilate, destroy! http://www.youtube.com/watch?v=LOqn8FxuyFs
        var $t = $(this);
        if (/Destroy/.test( $t.text() )) {
            $table.trigger('destroyPager');
            $t.text('Restore Pager');
        } else {
            $('table').trigger('applyWidgetId', 'pager');
            $t.text('Destroy Pager');
        }
        return false;
    });

    // Disable / Enable
    // **************
    $('.toggle').click(function() {
        var mode = /Disable/.test( $(this).text() );
        // using disablePager or enablePager
        $table.trigger( (mode ? 'disable' : 'enable') + 'Pager');
        $(this).text( (mode ? 'Enable' : 'Disable') + 'Pager');
        return false;
    });
    $table.bind('pagerChange', function() {
        // pager automatically enables when table is sorted.
        $('.toggle').text('Disable Pager');
    });

    // clear storage (page & size)
    $('.clear-pager-data').click(function() {
        // clears user set page & size from local storage, so on page
        // reload the page & size resets to the original settings
        $.tablesorter.storage( $table, 'tablesorter-pager', '' );
    });

    // go to page 1 showing 10 rows
    $('.goto').click(function() {
        // triggering "pageAndSize" without parameters will reset the
        // pager to page 1 and the original set size (10 by default)
        // $('table').trigger('pageAndSize')
        $table.trigger('pageAndSize', [1, 10]);
    });

});
