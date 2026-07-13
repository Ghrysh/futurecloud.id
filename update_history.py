import re

with open('/home/ype_/projects/ScanYuk/resources/views/admin/dashboard.blade.php', 'r') as f:
    scanyuk_content = f.read()

# Extract Live Chat section
start_idx = scanyuk_content.find('<div x-show="activeTab === \'livechat\'"')
end_idx = scanyuk_content.find('</div>\n\n    </div>\n\n    <script>')
if start_idx != -1 and end_idx != -1:
    livechat_ui = scanyuk_content[start_idx:end_idx]
    
    # Rebranding
    livechat_ui = livechat_ui.replace('activeTab === \'livechat\'', 'botTab === \'livechat\'')
    livechat_ui = livechat_ui.replace('bg-indigo-50', 'bg-blue-50')
    livechat_ui = livechat_ui.replace('border-indigo-200', 'border-blue-200')
    livechat_ui = livechat_ui.replace('bg-indigo-100', 'bg-blue-100')
    livechat_ui = livechat_ui.replace('text-indigo-500', 'text-blue-500')
    livechat_ui = livechat_ui.replace('bg-indigo-600', 'bg-blue-600')
    livechat_ui = livechat_ui.replace('hover:bg-indigo-700', 'hover:bg-blue-700')
    livechat_ui = livechat_ui.replace('bg-teal-500', 'bg-blue-500')
    livechat_ui = livechat_ui.replace('hover:bg-teal-600', 'hover:bg-blue-600')
    livechat_ui = livechat_ui.replace('ring-indigo-500', 'ring-blue-500')
    
    # Endpoints
    livechat_ui = livechat_ui.replace('/admin/live-chat/poll', '/admin/chatbot/live/poll')
    livechat_ui = livechat_ui.replace('/admin/live-chat/action', '/admin/chatbot/live/action')
    livechat_ui = livechat_ui.replace('/admin/live-chat/send', '/admin/chatbot/live/send')

with open('/home/ype_/projects/futurecloud/resources/views/admin/chatbot/history.blade.php', 'r') as f:
    history_content = f.read()

# Inject Tab UI at the top
tab_ui = """
<div class="mb-6 flex flex-col md:flex-row justify-between md:items-end gap-4">
    <div class="flex flex-col sm:flex-row bg-slate-100 p-1 rounded-xl w-full md:w-fit gap-1">
        <button @click="botTab = 'leads'" class="w-full sm:w-auto px-4 py-2 rounded-lg text-sm font-semibold transition-all" :class="botTab === 'leads' ? 'bg-white shadow-sm text-blue-600' : 'text-slate-500 hover:text-slate-700'">Inbox Follow Up</button>
        <button @click="botTab = 'livechat'" class="w-full sm:w-auto px-4 py-2 rounded-lg text-sm font-semibold transition-all" :class="botTab === 'livechat' ? 'bg-white shadow-sm text-blue-600' : 'text-slate-500 hover:text-slate-700'">Live Chat</button>
    </div>
</div>
"""

# Replace x-data
history_content = history_content.replace('x-data="historyViewer()"', 'x-data="{ ...historyViewer(), botTab: \'leads\' }"')

# Wrap existing content in x-show
parts = history_content.split('<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">', 1)
new_content = parts[0] + tab_ui + '<div x-show="botTab === \'leads\'">\n' + '<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">' + parts[1]

# Find the end of history viewer scope
# It ends with </div> right before <script>
script_idx = new_content.rfind('<script>')
end_div_idx = new_content.rfind('</div>', 0, script_idx)
if end_div_idx != -1:
    new_content = new_content[:end_div_idx] + '</div>\n\n' + livechat_ui + '\n\n</div>\n' + new_content[script_idx:]

with open('/home/ype_/projects/futurecloud/resources/views/admin/chatbot/history.blade.php', 'w') as f:
    f.write(new_content)

print("Done updating history.blade.php")
