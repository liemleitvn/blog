import $ from 'jquery'
import typeahead from "typeahead.js";
import Bloodhound from "bloodhound-js";

export default class SearchPost {
    constructor() {
        this.smartSearch = this.smartSearch.bind(this);
        this.el = $('#searchPost');
        this.smartSearch()
    }


    smartSearch (){
        if (!this.el) {
            return;
        }
        $(document).ready(($)=>{
            let engine = new Bloodhound({
                remote: {
                    url: '/post/search?s=%QUERY%',
                    wildcard: "%QUERY%",
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('search'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,

            });

            $('#searchPost').typeahead({
                hint: true,
                highlight: true,
                minLength: 2
            },
            {
                source: engine.ttAdapter(),
                name: "posts",
                limit: 3,
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown">' +
                            '<div class="list-group-item">Not Found</div>' +
                        '</div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown">'
                    ],
                    suggestion: function (data) {
                        console.log(data);
                        return '<a href="post/' + data.id + '" class="list-group-item">' + data.title + '</a>'
                    }
                }
            });
        });
    }
}

