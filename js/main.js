var Song = Backbone.Model.extend({
    initialize: function () {
        console.log('A new song has been created.');
    }
});

// with instantiating
var song = new Song({author: 'Alex'});
// with set
song.set('name', 'My fav song');
// with set using object with multiple attributes
song.set({
    title : 'Jackson',
    artist: 'Michael'
});

console.log(song);
console.log('To json: ', song.toJSON());
console.log('Get attr, title:', song.get('title'));
console.log('Remove attr, title', song.unset('title'));

console.log('Remove all attr', song.clear());