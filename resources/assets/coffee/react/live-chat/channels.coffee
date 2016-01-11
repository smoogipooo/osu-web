el = React.createElement

class LiveChat.Channels extends React.Component
  constructor: (props) ->
    super props

    @state = 
      channels: props.channels
  onChannelClick: (i) =>
    $.publish 'livechat:changed-channel', {
      id: parseInt(i)
    }

  render: =>
    el 'div', className: 'livechat-channels',
      @state.channels.map (channel) =>
        el 'div', 
          className: 'livechat-channels__tab', 
          onClick: @onChannelClick.bind(@, channel.channel_id),
          channel.name
    