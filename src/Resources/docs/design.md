interface GetLastSeenResponse
  getLastSeen()
  isOnline()

class UserGetLastSeenResponse implements GetLastSeenResponse

class NullGetLastSeenResponse implements GetLastSeenResponse
    isOnline(): return false
    getLastSeen(): return false

interface ActivityFormatter
  - isOnline()
  - lastSeen()

class CommandActivityFormatter
  - response
  - isOnline()

class JsonActivityFormatter