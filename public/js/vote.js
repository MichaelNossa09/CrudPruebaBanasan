$(document).ready(function () {
    // Agregar el token CSRF a todas las solicitudes AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.vote-up, .vote-down').on('click', function () {
        const publicacionId = $(this).data('publicacion-id');
        const voteType = $(this).hasClass('vote-up') ? 1 : 0; // 1 para voto positivo (upvote), 0 para voto negativo (downvote)

        $.ajax({
            type: 'POST',
            url: '/vote',
            data: {
                publicacion_id: publicacionId,
                type_vote: voteType,
            },
            success: function (response) {
                const votesElement = $(this).siblings('p');
                votesElement.text(response.votes);
            },
            error: function () {
                alert('Error al votar. Inténtalo nuevamente.');
            }
        });
    });
});
