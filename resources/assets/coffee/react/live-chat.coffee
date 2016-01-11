
el = React.createElement

class LiveChatIndex extends React.Component
  constructor: (props) ->
    super props

    @messagePool = null
    @state =
      messages: props.messages
      channels: props.channels
      choosenChannel: 0
      lastMessageId: 0
  componentDidMount: =>
    $.subscribe "livechat:pool", @appendMessages
    $.subscribe "livechat:changed-channel", @channelChanged
  channelChanged: (e, data) =>
    @setState messages: []
    @setState lastMessageId: 0
    clearInterval @messagePool
    poolCallback = =>
      callbackData = {
        k: "asd",
        ch_id: @state.choosenChannel,
        include: "user",
      }
      callbackData.m_id = @state.lastMessageId if @state.lastMessageId > 0

      $.get "/api/get_messages", callbackData
      .done (data) ->
        $.publish "livechat:pool", {
          messages: data
        }
    if data.id > 0
      @messagePool = setInterval poolCallback, 5000
    @setState choosenChannel: data.id, -> 
      poolCallback()

  appendMessages: (e, messagesData) =>
    newMessages = @state.messages
    messagesData.messages.map (message) -> newMessages.push(message)
    @setState messages: newMessages
    if newMessages.slice(-1)[0]?
      @setState lastMessageId: newMessages.slice(-1)[0].id

  render: =>
    el 'div', className: 'osu-layout__section osu-layout__section--full',
      el 'div', className: 'osu-layout__row osu-layout__row--with-gutter',
        el 'div', className: 'osu-layout__row--page livechat',
          el LiveChat.Channels,
            channels: @state.channels
          el 'ul', className: 'livechat-chat',
            @state.messages.map (message) ->
              formattedMessage = "[" + message.created_at + "]" + message.user.username + ": " + message.content              
              el 'li', className: "livechat-chat__line", formattedMessage

element = React.createElement LiveChatIndex,
  messages: messages
  channels: channels

target = document.getElementsByClassName('js-content')[0]

ReactDOM.render element, target