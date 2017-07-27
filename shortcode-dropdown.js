(function() {
	tinymce.PluginManager.add('sdropdown', function(editor) {
		const values = []

		window.shortcode_tags.map(text => {
			const value = `[${text}]`
			values.push({ text, value })
		})

		editor.addButton('sdropdown', {
			values,
			type: 'listbox',
			text: 'Shortcodes',
			onselect: e => {
				tinymce.activeEditor.selection.setContent(e.control.settings.value)
			},
		})
	})
})()
