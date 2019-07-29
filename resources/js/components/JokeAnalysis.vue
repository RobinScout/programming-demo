<template>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Word</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="loading">
                <td class="text-center" colspan="2">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                </td>
            </tr>
            <template v-else>
                <tr v-for="match in matchTerms">
                    <td>{{ match }}</td>
                    <td>{{ matchCount(match) }}</td>
                </tr>
            </template>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['jokes', 'matchTerms', 'loading'],
        methods: {
            matchCount(match) {
                return this.jokes.reduce((count, joke) => {
                    let matches = joke.value.match(new RegExp(match, 'gi'));
                    let matchesCount = matches ? matches.length : 0;
                    return count + matchesCount;
                }, 0);
            }
        }
    }
</script>
