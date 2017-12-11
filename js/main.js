var Song = Backbone.Model.extend({
    initialize: function () {
        console.log('A new song has been created.');
    },
    defaults: {
        genre: 'Jazz'
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

console.log('The song: ', song);
console.log('To json: ', song.toJSON());
console.log('Get attr, title:', song.get('title'));
console.log('Remove attr, title', song.unset('title'));

console.log('HasAttr, title: ', song.has('title'));

// console.log('Remove all attr', song.clear());
setTimeout(function () {
    song.clear();
    console.log('The song: ', song);
}, 5000);

setTimeout(function () {
    console.log('inside')
}, 1000);

