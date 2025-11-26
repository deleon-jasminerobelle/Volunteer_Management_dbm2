import React, { useEffect, useState } from 'react'
import { createRoot } from 'react-dom/client'
import { Users, Plus, Edit2, Trash2, BarChart3, PieChart, Search, X, Check } from 'lucide-react'

function VolunteerProfile({ volunteer, initialPolls }) {
  const [polls, setPolls] = useState(initialPolls || [])
  const [message, setMessage] = useState(null)
  const [votedOptions, setVotedOptions] = useState({})

  const handleVote = async (pollId, optionId) => {
    try {
      const res = await fetch(`/api/polls/${pollId}/vote`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': window.csrfToken },
        body: JSON.stringify({ volunteer_id: volunteer.id, option_id: optionId })
      })
      
      if (!res.ok) {
        const error = await res.json()
        setMessage({ type: 'error', text: error.message || 'Unable to register vote' })
        setTimeout(() => setMessage(null), 3000)
        return
      }

      const updated = await res.json()
      setPolls(polls.map(p => p.id === updated.id ? updated : p))
      setVotedOptions({ ...votedOptions, [pollId]: optionId })
      setMessage({ type: 'success', text: 'Vote registered successfully!' })
      setTimeout(() => setMessage(null), 2000)
    } catch (e) {
      console.error(e)
      setMessage({ type: 'error', text: 'An error occurred. Please try again.' })
      setTimeout(() => setMessage(null), 3000)
    }
  }

  return (
    <div className="min-h-screen bg-gray-50">
      <header className="bg-gradient-to-r from-orange-600 to-orange-500 text-white py-6 px-4 shadow">
        <div className="max-w-4xl mx-auto flex items-center justify-between">
          <div>
            <h1 className="text-2xl font-bold">Volunteer Profile</h1>
            <p className="text-orange-100">Welcome back, {volunteer.first_name}.</p>
          </div>
          <Users className="w-10 h-10 text-white" />
        </div>
      </header>

      {message && (
        <div className={`fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white z-50 ${
          message.type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`}>
          {message.text}
        </div>
      )}

      <main className="max-w-4xl mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <section className="md:col-span-1 bg-white p-4 rounded shadow">
          <h2 className="text-lg font-semibold mb-2">Profile</h2>
          <p className="text-sm text-gray-600">{volunteer.first_name} {volunteer.last_name}</p>
          <p className="text-sm text-gray-600">{volunteer.email}</p>
          <p className="text-sm text-gray-600">{volunteer.mobile}</p>
          <div className="mt-4">
            <h3 className="text-sm font-medium">Availability</h3>
            <p className="text-sm text-gray-600">{volunteer.availability}</p>
          </div>
        </section>

        <section className="md:col-span-2 bg-white p-4 rounded shadow">
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-lg font-semibold">Availability Polls</h2>
          </div>

          {polls.length === 0 && <p className="text-sm text-gray-500">No polls available</p>}

          <div className="space-y-4">
            {polls.map(poll => (
              <div key={poll.id} className="border rounded p-4">
                <div className="flex justify-between items-center mb-2">
                  <h3 className="font-medium">{poll.question}</h3>
                  <span className="text-sm text-gray-500">Votes: {poll.total_votes}</span>
                </div>
                <div className="space-y-2">
                  {poll.options.map(opt => {
                    const pct = poll.total_votes > 0 ? Math.round((opt.votes / poll.total_votes) * 100) : 0
                    const reachedLimit = poll.max_votes !== null && poll.total_votes >= poll.max_votes
                    const remaining = poll.max_votes !== null ? Math.max(0, poll.max_votes - poll.total_votes) : null
                    return (
                      <div key={opt.id} className="flex items-center gap-3">
                        <button
                          onClick={() => handleVote(poll.id, opt.id)}
                          className={`px-3 py-1 whitespace-nowrap ${
                            votedOptions[poll.id] === opt.id 
                              ? 'bg-green-500 text-white' 
                              : reachedLimit 
                                ? 'bg-gray-300 text-gray-600 cursor-not-allowed' 
                                : 'bg-orange-500 text-white hover:bg-orange-600'
                          } rounded transition-colors`}
                          disabled={reachedLimit}
                        >
                          {votedOptions[poll.id] === opt.id ? '✓ Voted' : reachedLimit ? 'Closed' : 'Vote'}
                        </button>
                        <div className="flex-1">
                          <div className="flex justify-between">
                            <span className="text-sm">{opt.text}</span>
                            <span className="text-sm text-gray-500">{opt.votes} ({pct}%)</span>
                          </div>
                          <div className="w-full h-2 bg-gray-200 rounded mt-1">
                            <div className="h-2 bg-orange-500 rounded" style={{ width: `${pct}%` }} />
                          </div>
                        </div>
                      </div>
                    )
                  })}
                  {poll.max_votes !== null && (
                    <div className="text-sm text-gray-600 mt-2">Remaining votes: {Math.max(0, poll.max_votes - poll.total_votes)}</div>
                  )}
                </div>
              </div>
            ))}
          </div>
        </section>
      </main>
    </div>
  )
}

// Mount if element exists and window.__VOLUNTEER_DASHBOARD_DATA__ is provided
document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('volunteer-dashboard')
  if (!container) return
  const data = window.__VOLUNTEER_DASHBOARD_DATA__ || {}
  const root = createRoot(container)
  root.render(<VolunteerProfile volunteer={data.volunteer} initialPolls={data.polls} />)
})

export default VolunteerProfile
