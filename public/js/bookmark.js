class Bookmark {

    static AddToBookmarks()
    {
        let lJobId = $( ".bookmark" ).data( 'id' );
        let lJob = this.GetBookmarkById( lJobId );
        if ( lJob ) {
            return false;
        }

        lJob = {
            "id": lJobId,
            "title": $( ".bookmark" ).data( 'title' ),
            "location": $( ".bookmark" ).data( 'location' ),
        };

        let lJobsList = JSON.parse( localStorage.getItem( JobsStorage.Bookmarks ) );
        if ( !lJobsList ) {
            lJobsList = [ lJob ];
        } else {
            lJobsList.push( lJob );
        }

        localStorage.setItem( JobsStorage.Bookmarks, JSON.stringify( lJobsList ) );

    }

    static GetBookmarkById( aJobId )
    {
        let lJobsList = JSON.parse( localStorage.getItem( JobsStorage.Bookmarks ) );
        if ( !lJobsList ) {
            return false;
        }

        for ( let lJob in lJobsList ) {
            if ( lJobsList[ lJob ].id === aJobId ) {
                return lJobsList[ lJob ];
            }
        }

        return false;
    }

    static ShowBookmarks()
    {
        let lJobsList = JSON.parse( localStorage.getItem( JobsStorage.Bookmarks ) );
        console.log(lJobsList);
        $("#list").DataTable({
            data: lJobsList,
            columns: [
                {  "data": "title", },
                {"data": "location",},
                {
                    "data": null,
                    render: function ( aData ) {
                        return '<a class="btn btn-info" href="/application/detail/' + aData.id + '">More </a>';
                    }
                },
            ],
            "dom": 'frtip',
            paging: true,
            searching: true,
            lengthMenu: [ [ 10, 20, 30, 40, 50, -1 ], [ 10, 20, 30, 40, 50, "All" ] ],
            pageLength: 20,
            ordering: false,
            responsive: true,
            columnDefs: [
                { orderable: false, targets: 0 }
            ],
            order: [ [ 0, "asc" ] ],
            language: { search: "" },
        });

    }
}