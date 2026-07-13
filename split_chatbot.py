import re

with open('resources/views/admin/chatbot/history.blade.php', 'r') as f:
    content = f.read()

# Remove the tab buttons
tab_buttons = """<div class="mb-6 flex flex-col md:flex-row justify-between md:items-end gap-4">
    <div class="flex flex-col sm:flex-row bg-slate-100 p-1 rounded-xl w-full md:w-fit gap-1">
        <button @click="botTab = 'leads'" class="w-full sm:w-auto px-4 py-2 rounded-lg text-sm font-semibold transition-all" :class="botTab === 'leads' ? 'bg-white shadow-sm text-blue-600' : 'text-slate-500 hover:text-slate-700'">Inbox Follow Up</button>
        <button @click="botTab = 'livechat'" class="w-full sm:w-auto px-4 py-2 rounded-lg text-sm font-semibold transition-all" :class="botTab === 'livechat' ? 'bg-white shadow-sm text-blue-600' : 'text-slate-500 hover:text-slate-700'">Live Chat</button>
    </div>
</div>
"""
content = content.replace(tab_buttons, '')

# Restore x-data
content = content.replace('x-data="{ ...historyViewer(), botTab: \'leads\' }"', 'x-data="historyViewer()"')

# Remove <div x-show="botTab === 'leads'"> wrapper
content = content.replace('<div x-show="botTab === \'leads\'">\n', '', 1)

# Extract Live Chat UI
start_live = content.find('<div x-show="botTab === \'livechat\'"')
if start_live != -1:
    end_live = content.find('</div>\n\n</div>\n    <div x-show="isOpen"')
    if end_live != -1:
        livechat_ui = content[start_live:end_live + 6]
        
        # Remove livechat_ui from history
        content = content[:start_live] + content[end_live + 6:]
        
        # We also need to remove the closing div of <div x-show="botTab === 'leads'"> which was placed right before livechat_ui
        content = content.replace('</div>\n\n\n<div x-show="botTab === \'livechat\'"', '\n<div x-show="botTab === \'livechat\'"')
        content = content.replace('</div>\n\n\n    <div x-show="isOpen"', '\n    <div x-show="isOpen"')

        # Clean up the extra </div> we added for the leads wrapper
        # The extra </div> was at the end of parts[1]
        content = content.replace('</div>\n\n    <div x-show="isOpen"', '\n    <div x-show="isOpen"')

        with open('resources/views/admin/chatbot/history.blade.php', 'w') as f:
            f.write(content)
        
        # Now create live.blade.php
        live_content = """@extends('layouts.admin-app')
@section('title', 'Live Chat')
@section('header_title', 'Live Chat')

@section('content')
<div class="mx-4 sm:mx-0">
""" + livechat_ui.replace('x-show="botTab === \'livechat\'" style="display: none;"', '') + """
</div>
@endsection
"""
        with open('resources/views/admin/chatbot/live.blade.php', 'w') as f:
            f.write(live_content)
        print("Successfully split to history.blade.php and live.blade.php")
    else:
        print("Could not find end of livechat")
else:
    print("Could not find start of livechat")

