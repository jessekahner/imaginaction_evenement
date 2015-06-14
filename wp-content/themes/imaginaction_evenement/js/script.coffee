$ = jQuery


'use strict'
App =
	debug: null
	definevariables:() ->
		App.fancyOptions =
			# padding: 0
			margin: [20,60,20,60]
			helpers : {
				title : null
			}
		App.formulaire = $('.encan').find('div.wpcf7[role=form]')

	init:() ->
		App.definevariables()

		# App.formulaire.hide()
		App.formulaire.each ()->
			_this = $(this)
			_this.before '<p><a href="#'+_this.attr("id")+'" class="lien-mise fancybox btn-lg btn btn-default">Faites une mise!</a></p>'
			# _this.hide()

		$(".fancybox").fancybox App.fancyOptions

jQuery ->
	App.init()