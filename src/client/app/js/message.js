function Message(type, payload) {
  this.type = type;
  this.payload = payload;
}

Message.prototype = {
  constructor: Message,
  getType: function() {
    return this.type;
  },
  getPayload: function() {
    return this.payload;
  }
};

Message.TYPE_STATUS_UPDATES = 'statusUpdates';
Message.TYPE_POPULAR_CHANNELS_REQUEST = 'popularChannelsRequest';
Message.TYPE_POPULAR_CHANNELS_RESPONSE = 'popularChannelsResponse';
Message.TYPE_MOST_ACTIVE_WATCHERS_REQUEST = 'mostActiveWatchersRequest';
Message.TYPE_MOST_ACTIVE_WATCHERS_RESPONSE = 'mostActiveWatchersResponse';
