<template>
    <div>
        <input type="text" class="form-control" placeholder="Search" v-model="searchTerm" @input="debounceSearch">
        <ul class="list-group mt-1">
            <li class="list-group-item text-center" v-if="loading">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class="sr-only">Loading...</span>
            </li>
            <template v-else-if="jokes && jokes.length > 0">
              <li v-for="joke in jokes" :key="joke.id" class="list-group-item">
                <span v-html="valueWithBoldSearch(joke.value)"></span>
            </li>
            </template>
             <li v-else class="list-group-item">No results</li>
        </ul>
  </div>
    </div>
</template>

<script>
    import { debounce } from 'lodash';
    import axios from 'axios'
    const CancelToken = axios.CancelToken;
    let cancelSearch = null;

    export default {
        data() {
            return {
                loading: false,
                searchTerm: '',
                jokes: []
            };
        },
        methods: {
            executeSearch() {
                if (cancelSearch) {
                    cancelSearch();
                    cancelSearch = null;
                }

                if (!this.searchTerm) {
                    return;
                }

                this.loading = true;
                this.jokes = [];

                this.$http.get('/joke/search', {
                    params: { value: this.searchTerm },
                    cancelToken: new CancelToken(function executor(c) {
                        cancelSearch = c;
                    })
                }).then(({ data }) => {
                    this.jokes = data;
                }).catch(thrown => {
                  if (!axios.isCancel(thrown)) {
                    // Handle error
                  }
                }).finally(() => {
                    this.loading = false;
                    cancelSearch = null;
                });
            },
            debounceSearch: debounce(function () { this.executeSearch(); }, 250),
            valueWithBoldSearch(value) {
                return value.replace(new RegExp(this.searchTerm.trim(), "gi"), match => {
                    return '<strong>' + match + '</strong>';
                });
            }
        }
    }
</script>
