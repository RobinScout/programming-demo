<template>
    <ul class="list-group">
        <li class="list-group-item text-center" v-if="loading">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span class="sr-only">Loading...</span>
        </li>
        <template v-else-if="jokes && jokes.length > 0">
          <li v-for="joke in jokes" :key="joke.id" class="list-group-item">
            <span v-html="valueWithBoldMatch(joke.value)"></span>
        </li>
        </template>
         <li v-else class="list-group-item">No results</li>
    </ul>
</template>

<script>
    export default {
        props: ['jokes', 'loading', 'matchTerms'],
        methods: {
            valueWithBoldMatch(value) {
                if (!this.matchTerms || this.matchTerms.length === 0) {
                    return value;
                }
                let replaceString = value;
                this.matchTerms.forEach((matchTerm) => {
                    replaceString = replaceString.replace(new RegExp(matchTerm.trim(), 'gi'), match => {
                        return '<strong>' + match + '</strong>';
                    });
                });

                return replaceString;
            }
        }
    }
</script>
